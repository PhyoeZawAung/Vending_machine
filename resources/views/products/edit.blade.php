<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.update', $product['id']) }}">
                        @csrf

                        <!-- Prodcut name -->
                        <div>
                            <x-input-label for="product_name" value="Product Name" />
                            <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" :value="$product['name'] ?? old('product_name')"  autofocus />
                            <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-input-label for="product_price" value="Price" />

                            <x-text-input id="product_price" class="block mt-1 w-full"
                                            type="text"
                                            name="product_price"
                                            :value="$product['price'] ?? old('product_price')" />

                            <x-input-error :messages="$errors->get('product_price')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-input-label for="product_quantity" value="Quantity" />

                            <x-text-input id="product_quantity" class="block mt-1 w-full"
                                            type="text"
                                            name="product_quantity"
                                            :value="$product['quantity_available'] ?? old('product_quantity')" />

                            <x-input-error :messages="$errors->get('product_quantity')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                Update Product
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
