<!-- Sidebar - Sticky on Desktop -->
<div class="lg:col-span-1">
    <div class="sticky top-24">
        <div class="w-full">
            <!-- Main Sidebar Container -->
            <aside
                class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">

                <!-- Header Accent -->
                <div class="h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                <div class="p-6 space-y-6">

                    <!-- Search Location Section -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Search Destination
                            </h3>
                        </div>

                        <form action="{{ route('aventure.search') }}" method="GET" class="space-y-3">
                            @if(request('date_start'))
                                <input type="hidden" name="date_start" value="{{ request('date_start') }}">
                            @endif
                            @if(request('date_end'))
                                <input type="hidden" name="date_end" value="{{ request('date_end') }}">
                            @endif

                            <div class="relative group">
                                <input type="text" name="destination" value="{{ request('destination') }}"
                                    placeholder="Where do you want to go?"
                                    class="w-full px-4 py-3 pl-10 text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500" />
                                <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400 dark:text-gray-500 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <button type="submit"
                                class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl hover:from-indigo-700 hover:to-indigo-800 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                                Search Adventures
                            </button>
                        </form>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-gradient-to-r from-transparent via-gray-200 dark:via-gray-700 to-transparent">
                    </div>

                    <!-- Date Range Filter Section -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Date Range
                            </h3>
                        </div>

                        <form action="{{ route('aventure.search') }}" method="GET" class="space-y-3">
                            @if(request('destination'))
                                <input type="hidden" name="destination" value="{{ request('destination') }}">
                            @endif

                            <div class="grid grid-cols-2 gap-2">
                                <div class="relative">
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5">
                                        From
                                    </label>
                                    <input type="date" name="date_start" value="{{ request('date_start') }}"
                                        class="w-full px-3 py-2 text-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" />
                                </div>

                                <div class="relative">
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5">
                                        To
                                    </label>
                                    <input type="date" name="date_end" value="{{ request('date_end') }}"
                                        class="w-full px-3 py-2 text-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" />
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <button type="submit"
                                    class="flex-1 px-3 py-2 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg hover:from-indigo-700 hover:to-indigo-800 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-700 transition-all duration-200 active:scale-95">
                                    Apply
                                </button>

                                <a href="{{ route('aventure.index') }}"
                                    class="p-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-red-50 dark:hover:bg-gray-700 transition-all duration-200 inline-flex items-center justify-center"
                                    title="Reset Filters">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters Summary -->
                    @if(request('destination') || request('date_start') || request('date_end'))
                        <div
                            class="pt-2 px-3 py-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-100 dark:border-indigo-800 transition-all duration-200">
                            <p class="text-xs text-indigo-700 dark:text-indigo-300">
                                <span class="font-semibold block mb-1">Active filters:</span>
                                <span class="inline-block text-xs">
                                    @if(request('destination'))
                                        <span class="mr-2">📍 {{ request('destination') }}</span>
                                    @endif
                                    @if(request('date_start'))
                                        <span class="mr-2">📅 From
                                            {{ \Carbon\Carbon::parse(request('date_start'))->format('M d, Y') }}</span>
                                    @endif
                                    @if(request('date_end'))
                                        <span>to {{ \Carbon\Carbon::parse(request('date_end'))->format('M d, Y') }}</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                    @endif

                </div>
            </aside>
        </div>
    </div>
</div>