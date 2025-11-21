@props(['total' => 0])

<div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-md border border-gray-100 dark:border-gray-700 transition-colors duration-200">
    <div class="p-5">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                        Total Adventures
                    </dt>
                    <dd>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $total }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>