<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSaveRequest;
use App\Models\Product;
use App\Models\Transition;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->query('sort_by', 'id'); // Default sort by 'name'
        $order = $request->query('order', 'asc'); // Default order is 'asc'
        $products = Product::orderBy($sortBy, $order)->paginate(10); // all products

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json([
                'products' => $products,
                'sortBy' => $sortBy,
                'oder' => $order
            ]);
        }
        return view('products.list', compact(['products', 'sortBy', 'order']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSaveRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create([
                'name' => $request['product_name'],
                'description' => "This is product description",
                'price' => $request['product_price'],
                'quantity_available' => $request['product_quantity']
            ]);
            DB::commit();
            info("Product save");
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'product' => $product,
                    'message' => "product created"
                ]);
            }
            return redirect(route('products.list'));
        } catch (Exception $e) {
            DB::rollback();
            info("Error creating product" . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (!Gate::allows('is-user')) {
            abort('403');
        }
        return view('products.buy')->with('product', $product);
    }


    public function buy(Request $request)
    {

        $product = Product::find($request->product_id);

        if ($request->user()->amount < ($product->price * $request->quantity)) {
            return back()->withErrors(['insufficient_amount' => "you do not have insufficient amount to purchase"]);
        }

        $request->validate([
            'quantity' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) use ($request, $product) {
                    // Assuming you're comparing to a product price

                    if ($product && $value > $product->quantity_available) {
                        $fail('There is no sufficient quantity to buy');
                    }
                },
            ]
        ]);

        $this->makeTransition($request->user(), $product, $request->quantity);

        return redirect(route('products'));
    }

    protected function makeTransition($user, $product, $quantity)
    {

        try {
            DB::beginTransaction();

            $transition = Transition::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'total_price' => $product->price * $quantity,
                'transaction_date' => Carbon::now(),
            ]);

            $product->update([
                'quantity_available' => $product['quantity_available'] -  $quantity,
            ]);

            User::where('id', $user->id)->update(['amount' => ($user->amount - $transition->total_price)]);
            User::where('role', 1)->update(['amount' => ($user->amount + $transition->total_price)]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            info('Error transition' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, Request $request)
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json([
                'product' => $product,
            ]);
        }
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductSaveRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            Product::find($id)->update([
                'name' => $request['product_name'],
                'description' => "This is product description",
                'price' => $request['product_price'],
                'quantity_available' => $request['product_quantity']
            ]);
            DB::commit();
            info("Product save");

            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'product' => Product::find($id),
                    'message' => "product updated"
                ]);
            }
            return redirect(route('products.list'));
        } catch (Exception $e) {
            DB::rollback();
            info("Error creating product" . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            DB::beginTransaction();
            Product::findOrFail($id)->delete();
            DB::commit();
            info("Product save");
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => "product deleted"
                ]);
            }
            return redirect(route('products.list'));
        } catch (Exception $e) {
            DB::rollback();
            info("Error creating product" . $e->getMessage());
        }
    }
}
