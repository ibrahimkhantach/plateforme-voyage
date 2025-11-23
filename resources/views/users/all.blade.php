<x-admin-layout>

    <section class="pt-16">
        <!-- Top Bar: Title & Search -->
        <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700 rounded-t-lg">
            <div class="w-full mb-1">
                <div class="mb-4">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All Users</h1>
                </div>
                
                <div class="sm:flex">
                    <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                        <form class="lg:pr-3" action="#" method="GET">
                            <label for="users-search" class="sr-only">Search</label>
                            <div class="relative mt-1 lg:w-64 xl:w-96">
                                <input type="text" name="email" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(session("success"))
            <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 rounded shadow-md mb-4" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                    </svg>
                    <p>{{ session("success") }}</p>
                </div>
        @endif
        <!-- Table Container -->
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Name & Email
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Description
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Status
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse($users as $user)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150">
        
                                    <td class="p-4">
                                        <div class="flex items-center space-x-3">
                                            <!-- Image Logic: Check if image exists, otherwise show initials -->
                                            @if($user->image)
                                                <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }} avatar">
                                            @else
                                                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                                    <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                            @endif

                                            <div>
                                                <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $user->description }}
                                    </td>
                                    
                                    <td class="p-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($user->isActif)
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div> 
                                                <span class="text-green-600 dark:text-green-400">Active</span>
                                            @else
                                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> 
                                                <span class="text-red-600 dark:text-red-400">Inactive</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <!-- Delete Button -->
                                            <form action="{{ route("user.destroy",[$user->id]) }}" method="POST" class="inline" onsubmit="return confirm('Are Sue Delete this user ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 000-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                        No users found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="p-4 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-b-lg">
            {{ $users->links() }}
        </div>
    </section>
</x-admin-layout>