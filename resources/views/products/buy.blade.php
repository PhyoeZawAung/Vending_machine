<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buy Product
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    @if ($errors->has('insufficient_amount'))
                        <div class="text-sm text-red-600 space-y-1">
                            {{ $errors->first('insufficient_amount') }}
                        </div>
                    @endif

                        <!-- Prodcut name -->
                        <div>
                            <x-input-label for="product_name" value="Product Name" />
                            <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" :value="$product['name']"  autofocus disabled/>
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-input-label for="product_price" value="Price" />

                            <x-text-input id="product_price" class="block mt-1 w-full"
                                            type="text"
                                            name="product_price"
                                          :value="$product['price']" disabled/>
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-input-label for="product_quantity" value="Available quantity" />

                            <x-text-input id="product_quantity" class="block mt-1 w-full"
                                            type="text"
                                            name="product_quantity"
                                          :value="$product['quantity_available']" disabled/>

                        </div>
                        <form method="POST" action="{{route('products.buy')}}">
                            @csrf
                            <input type="hidden" value={{$product['id']}} name="product_id">
                            <!-- Input Number -->
                            <x-input-label for="quantity" value="Quantity" />
                            <x-text-input id="product_quantity" class="block mt-1 w-full"
                                                type="number"
                                                name="quantity"
                                                oninput="validateNumber(this)"
                                                :value="old('quantity')" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-3">
                                    Buy Now
                                </x-primary-button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
function validateNumber(input) {
    available_quantity = @json($product['quantity_available']);
    if(input.value > available_quantity) {
        input.value = available_quantity;
    }
    input.value = input.value.replace(/[^0-9]/g, '');
}
</script>
</x-app-layout>
