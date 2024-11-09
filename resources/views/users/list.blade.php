<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="relative flex flex-col w-full h-full overflow-scroll bg-white shadow-md rounded-lg bg-clip-border">
                        <div class="flex items-end">

                            <a href={{route('users.create')}} class="ms-3 border px-2 py-1 rounded-md">
                                add new user
                            </a>
                        </div>

                        <table class="w-full text-left table-auto min-w-max">
                          <thead>
                              <tr>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                      <a href="{{ route('users.list', ['sort_by' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
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
                                    <a href="{{ route('users.list', ['sort_by' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
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
                                    <a href="{{ route('users.list', ['sort_by' => 'role', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Role
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
                                    <a href="{{ route('users.list', ['sort_by' => 'email', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Email
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                          stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                      </svg>
                                      </p>
                                  </th>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                        <a href="{{ route('users.list', ['sort_by' => 'password_hash', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Password
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                          stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                      </svg>
                                      </p>
                                  </th>
                                  <th
                                  class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                    <a href="{{ route('users.list', ['sort_by' => 'amount', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                      <p
                                      class="flex items-center justify-between gap-2 text-sm font-normal leading-none text-slate-800">
                                      Available Money
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
                            @foreach ($users as $user)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $user['id'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $user['name'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $user['role'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $user['email'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $user['password_hash'] }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $user['amount'] . ' USD'}}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <div class="flex gap-2">
                                            <a class="bg-blue-500 text-gray-800 border px-2 py-1 rounded-md" href={{ route('users.edit', $user['id']) }}>Edit</a>
                                            <a class="bg-red-500 text-gray-800 border px-2 py-1 rounded-md"  href={{ route('users.delete', $user['id']) }}>Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div class=" px-4 py-3">
                            {{ $users->appends(['sort_by' => $sortBy, 'order' => $order])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



