<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->query('sort_by', 'id'); // Default sort by 'name'
        $order = $request->query('order', 'asc'); // Default order is 'asc'

        $users = User::where('id','<>', Auth::id())
        ->orderBy($sortBy,$order)
        ->paginate(15);

        $users->getCollection()->transform(function ($user) {
            $user->password_hash = Crypt::decryptString($user->password_hash);
            return $user;
        });

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json([
                'products' => $users,
                'sortBy' => $sortBy,
                'oder' => $order
            ]);
        }

        return view('users.list',compact(['users','sortBy', 'order']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserSaveRequest $request)
    {
        try{
            DB::beginTransaction();
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'password_hash' => Crypt::encryptString($request['password']),
                'amount' => $request['amount'],
            ]);
            DB::commit();
            info("Product save");
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'product' => $user,
                    'message' => "user created"
                ]);
            }
            return redirect(route('users.list'));
        }catch(Exception $e) {
            DB::rollback();
            info("Error creating user" . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user,Request $request)
    {
        $user->password_hash = Crypt::decryptString($user['password_hash']);
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json([
                'product' => $user,
            ]);
        }
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserSaveRequest $request, string $id)
    {
        try{
            DB::beginTransaction();

            User::find($id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'password_hash' => Crypt::encryptString($request['password']),
                'amount' => $request['amount'],
            ]);

            DB::commit();
            info("user save");

            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'product' => User::find($id),
                    'message' => "product updated"
                ]);
            }
            return redirect(route('users.list'));
        }catch(Exception $e) {
            DB::rollback();
            info("Error creating user" . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        try{
            DB::beginTransaction();
            User::findOrFail($id)->delete();
            DB::commit();
            info("user save");
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => "product deleted"
                ]);
            }
            return redirect(route('users.list'));
        }catch(Exception $e) {
            DB::rollback();
            info("Error creating user" . $e->getMessage());
        }
    }
}
