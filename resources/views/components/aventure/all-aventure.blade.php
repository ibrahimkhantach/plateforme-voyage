<section class="container mx-auto px-4 py-8 max-w-4xl">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Adventures</h1>
        <p class="mt-2 text-gray-700 dark:text-gray-300">Discover amazing adventures from our community</p>
    </div>

    <!-- Adventures Feed -->
    @forelse($aventures as $adventure)

    @php
        $images = Storage::disk('public')->files($adventure->images);
    @endphp

    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md mb-6 overflow-hidden hover:shadow-xl transition-shadow duration-300">

        <!-- User Info Header -->
        <div class="px-4 py-3 border-b border-gray-200 dark:border-zinc-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 mr-3">
                    @if($adventure->user && $adventure->user->image)
                        <img src="{{ asset('storage/' . $adventure->user->image) }}"
                             alt="{{ $adventure->user->name }}"
                             class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg">
                            {{ $adventure->user ? strtoupper(substr($adventure->user->name, 0, 1)) : 'U' }}
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h6 class="font-bold text-gray-900 dark:text-white">
                        {{ $adventure->user ? $adventure->user->name : 'Unknown User' }}
                    </h6>
                    <small class="text-gray-500 dark:text-gray-400 text-sm">
                        {{ $adventure->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Adventure Content -->
        <div class="p-4">
            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">{{ $adventure->title }}</h4>

            @if($adventure->destination)
            <p class="text-gray-600 dark:text-gray-300 mb-2 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
                {{ $adventure->destination }}
            </p>
            @endif

            <p class="text-gray-700 dark:text-gray-300 mb-3">{{ $adventure->details }}</p>

        </div>

        <!-- Adventure Images Carousel -->
        @if(!empty($images) && count($images) > 0)
        <div class="relative" x-data="{ currentSlide: 0, totalSlides: {{ count($images) }} }">

            <!-- Images -->
            <div class="relative overflow-hidden" style="height: 500px;">
                @foreach($images as $index => $image)
                <div x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-full"
                     class="absolute inset-0">
                    <img src="{{ asset('storage/' . $image) }}"
                         alt="Adventure image {{ $index + 1 }}"
                         class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            @if(count($images) > 1)
            <button @click="currentSlide = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full p-2 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="currentSlide = currentSlide === totalSlides - 1 ? 0 : currentSlide + 1"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full p-2 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            @endif

            <!-- Image Counter -->
            @if(count($images) > 1)
            <div class="absolute top-3 right-3 bg-black bg-opacity-75 text-white px-3 py-1 rounded-full text-sm">
                <span x-text="currentSlide + 1"></span> / {{ count($images) }}
            </div>
            @endif

            <!-- Indicators -->
            @if(count($images) > 1)
            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2">
                @foreach($images as $index => $image)
                <button @click="currentSlide = {{ $index }}"
                        :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white bg-opacity-50'"
                        class="w-2 h-2 rounded-full transition-all hover:bg-white">
                </button>
                @endforeach
            </div>
            @endif

        </div>
        @endif

    </div>

    @empty
    <div class="text-center py-12">
        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
        </svg>

        <h4 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">No adventures yet</h4>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Be the first to share your adventure!</p>

        @auth
        <a href="{{ route('aventures.create') }}"
           class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Adventure
        </a>
        @endauth
    </div>
    @endforelse

    <!-- Pagination -->
    @if($aventures->hasPages())
    <div class="flex justify-center mt-8">
        {{ $aventures->links() }}
    </div>
    @endif

</section>
