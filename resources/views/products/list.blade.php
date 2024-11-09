<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>
    @php
        $route = 'products';
        $route = Auth::user()->role == 1 ? $route . '.list' : $route;
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="relative flex flex-col w-full h-full overflow-scroll bg-white shadow-md rounded-lg bg-clip-border">
                        @can('is-admin')
                            <div class="flex items-end">
                                <a href={{ route('products.create') }} class="ms-3 border px-2 py-1 rounded-md">
                                    add new
                                </a>
                            </div>
                        @endcan

                        <table class="w-full text-left table-auto min-w-max">
                          <thead>
                              <tr>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                      <a href="{{ route($route, ['sort_by' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      ID
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                          stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                      </svg>
                                      </p>
                                      </a>
                                  </th>

                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                    <a href="{{ route($route, ['sort_by' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Name
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                          stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                      </svg>
                                      </p>
                                    </a>
                                  </th>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                    <a href="{{ route($route, ['sort_by' => 'price', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Price
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                          stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                      </svg>
                                      </p>
                                    </a>
                                  </th>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                    <a href="{{ route($route, ['sort_by' => 'quantity_available', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Available Quantity
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                          stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                      </svg>
                                      </p>
                                    </a>
                                  </th>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Action

                                      </p>
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($products as $product)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $product['id'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $product['name'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $product['price'] . ' USD' }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $product['quantity_available'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        @can('is-admin')
                                            <div class="flex gap-2">
                                                <a class="bg-blue-500 text-gray-800 border px-2 py-1 rounded-md" href={{ route('products.edit', $product['id']) }}>Edit</a>
                                                <a class="bg-red-500 text-gray-800 border px-2 py-1 rounded-md"  href={{ route('products.delete', $product['id']) }}>Delete</a>
                                            </div>
                                        @endcan
                                        @can('is-user')
                                            <div class="flex gap-2">
                                                <a class="bg-red-500 text-gray-800 border px-2 py-1 rounded-md"  href={{ route('products.show', $product['id']) }}>View</a>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div class=" px-4 py-3">
                            {{ $products->appends(['sort_by' => $sortBy, 'order' => $order])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



