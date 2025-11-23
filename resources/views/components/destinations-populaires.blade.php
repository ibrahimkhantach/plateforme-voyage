@props(['destinations'])

<div class="py-8">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($destinations as $dest)
            <a href="/search?destination={{ urlencode($dest->destination) }}" class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden block">
                
                <div class="relative h-48 overflow-hidden">
                    <img 
                        src="https://ui-avatars.com/api/?name={{ urlencode($dest->destination) }}&background=random&size=512&font-size=0.33" 
                        alt="{{ $dest->destination }}" 
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                    >
                    
                    <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded-md border border-white/20">
                        {{ $dest->total }} Aventures
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors capitalize">
                        {{ $dest->destination }}
                    </h3>
                    
                    <div class="mt-3 flex items-center text-sm text-indigo-600 dark:text-indigo-400 font-medium">
                        <span>Voir la liste</span>
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>