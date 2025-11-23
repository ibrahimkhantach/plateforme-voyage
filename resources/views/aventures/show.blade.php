<x-app-layout>
    <section class="min-h-screen bg-gray-50 dark:bg-gray-950 transition-colors duration-300">
        <!-- Top Navigation Spacing -->
        <div class="h-20"></div>
        
        <a href="{{ route("aventure.pdf") }}" 
        class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded-lg font-semibold text-sm uppercase tracking-widest transition-all duration-200 shadow-md hover:shadow-lg active:scale-95"
        title="Télécharger toutes les aventures en PDF">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Télécharger PDF</span>
        </a>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-3">

                    <!-- Header -->
                    <div class="mb-8 text-center lg:text-left">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Mon Adventures</h1>
                            </div>

                            <!-- Add Adventure Button -->
                            <a href="{{ route('aventure.create') }}"
                                class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Add Adventure') }}
                            </a>
                        </div>
                    </div>

                    <!-- Adventures Feed -->
                    @forelse($aventures as $adventure)

                        @php
                            $images = Storage::disk('public')->files($adventure->images);
                        @endphp

                        <div
                            class="bg-white dark:bg-zinc-800 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 mb-6 overflow-hidden border border-gray-100 dark:border-zinc-700">

                            <!-- User Info Header -->
                            <div
                                class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700 bg-gradient-to-r from-gray-50 to-white dark:from-zinc-800 dark:to-zinc-800">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            @if($adventure->user && $adventure->user->image)
                                                <img src="{{ asset('storage/' . $adventure->user->image) }}"
                                                    alt="{{ $adventure->user->name }}"
                                                    class="w-12 h-12 rounded-full object-cover ring-2 ring-indigo-500">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold text-lg ring-2 ring-indigo-500">
                                                    {{ $adventure->user ? strtoupper(substr($adventure->user->name, 0, 1)) : 'U' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="font-bold text-gray-900 dark:text-white text-sm">
                                                {{ $adventure->user ? $adventure->user->name : 'Unknown User' }}
                                            </h6>
                                            <small class="text-gray-500 dark:text-gray-400 text-xs">
                                                {{ $adventure->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                    @if(auth()->check() && (auth()->id() === $adventure->user_id || auth()->user()->role === 'admin'))

                                        <div class="flex gap-2 items-center">

                                            {{-- Edit Button --}}
                                            <a href="{{ route('aventure.edit', $adventure) }}"
                                                class="p-2 text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('aventure.destroy', $adventure) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this adventure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors"
                                                    title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Adventure Content -->
                            <div class="p-6">
                                <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">{{ $adventure->title }}
                                </h4>

                                @if($adventure->destination)
                                    <p class="text-gray-600 dark:text-gray-300 mb-3 flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-semibold">{{ $adventure->destination }}</span>
                                    </p>
                                @endif

                                <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed text-sm line-clamp-3">
                                    {{ $adventure->details }}</p>

                            </div>

                            <!-- Adventure Images Carousel -->
                            @if(!empty($images) && count($images) > 0)
                                <div class="relative border-t border-gray-200 dark:border-zinc-700"
                                    x-data="{ currentSlide: 0, totalSlides: {{ count($images) }} }">

                                    <!-- Images -->
                                    <div class="relative overflow-hidden bg-black" style="height: 400px;">
                                        @foreach($images as $index => $image)
                                            <div x-show="currentSlide === {{ $index }}"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 transform translate-x-full"
                                                x-transition:enter-end="opacity-100 transform translate-x-0"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 transform translate-x-0"
                                                x-transition:leave-end="opacity-0 transform -translate-x-full"
                                                class="absolute inset-0">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Adventure image {{ $index + 1 }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Navigation Buttons -->
                                    @if(count($images) > 1)
                                        <button @click="currentSlide = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1"
                                            class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white rounded-full p-2 transition-all duration-200 z-10">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </button>
                                        <button @click="currentSlide = currentSlide === totalSlides - 1 ? 0 : currentSlide + 1"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white rounded-full p-2 transition-all duration-200 z-10">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Image Counter -->
                                    @if(count($images) > 1)
                                        <div
                                            class="absolute top-3 right-3 bg-black/75 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            <span x-text="currentSlide + 1"></span> / {{ count($images) }}
                                        </div>
                                    @endif

                                    <!-- Indicators -->
                                    @if(count($images) > 1)
                                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2">
                                            @foreach($images as $index => $image)
                                                <button @click="currentSlide = {{ $index }}"
                                                    :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white/50'"
                                                    class="w-2 h-2 rounded-full transition-all hover:bg-white">
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            @endif

                        </div>

                    @empty
                        <div class="text-center py-16">
                            <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-600 mb-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>

                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No adventures yet</h4>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Be the first to share your adventure!</p>

                            @auth
                                <a href="{{ route('aventure.create') }}"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded-lg transition-all duration-200 shadow-md hover:shadow-lg font-semibold">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Create Adventure
                                </a>
                            @endauth
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($aventures->hasPages())
                        <div class="flex justify-center mt-10">
                            {{ $aventures->links() }}
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </section>
</x-app-layout>