<x-app-layout>

    @php
        $images = Storage::disk("public")->files($adventure->images)
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Adventure') }}: {{ $adventure->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Success Message --}}
            @if(session("success"))
                <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 rounded shadow-md mb-4" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                    </svg>
                    <p>{{ session("success") }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition-colors duration-200 w-full md:w-[60%] mx-auto">                
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Update Adventure Details</h2>

                <form action="{{ route('aventure.update', $adventure) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- CRITICAL for Update methods --}}

                    {{-- Title Input --}}
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $adventure->title) }}" 
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 p-2 shadow-sm 
                                    bg-white dark:bg-gray-900 text-gray-900 dark:text-white
                                    focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Destination Input --}}
                    <div class="mb-4">
                        <label for="destination" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Destination</label>
                        <input type="text" name="destination" id="destination" value="{{ old('destination', $adventure->destination) }}" 
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 p-2 shadow-sm 
                                    bg-white dark:bg-gray-900 text-gray-900 dark:text-white
                                    focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                        @error('destination')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Details Input --}}
                    <div class="mb-4">
                        <label for="details" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Details</label>
                        <textarea name="details" id="details" rows="4" 
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 p-2 shadow-sm 
                                        bg-white dark:bg-gray-900 text-gray-900 dark:text-white
                                        focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">{{ old('details', $adventure->details) }}</textarea>
                        @error('details')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Existing Images Section (Assumes $adventure->images is a collection) --}}
                    @if(isset($images) && count($images) > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Images (Select to Delete)</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach($images as $image)
                                    <div class="relative group border dark:border-gray-600 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Adventure Image" class="w-full h-32 object-cover">
                                        
                                        {{-- Delete Checkbox Overlay --}}
                                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="flex items-center bg-white dark:bg-gray-800 rounded px-2 py-1">
                                                <input type="checkbox" name="delete_images[]" value="{{ $image }}" id="img_{{ $image}}" 
                                                    class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                                <label for="img_{{ $image}}" class="ml-2 text-xs text-red-600 font-bold cursor-pointer">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Add New Images --}}
                    <div class="mb-6">
                        <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Add New Images</label>
                        
                        <div class="relative">
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 p-2 text-sm text-gray-500 dark:text-gray-400
                                        bg-white dark:bg-gray-900
                                        file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                        file:text-sm file:font-semibold 
                                        file:bg-indigo-50 dark:file:bg-indigo-900 
                                        file:text-indigo-700 dark:file:text-indigo-300
                                        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800 cursor-pointer">
                        </div>

                        @error('images')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        {{-- New Images Preview --}}
                        <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4 hidden">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('aventure.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Update Adventure
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Javascript for New Image Previews (Same as Create) --}}
    <script>
        const imageInput = document.getElementById('images');
        const previewContainer = document.getElementById('imagePreviewContainer');
        let selectedFiles = [];

        imageInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            
            newFiles.forEach(file => {
                const isDuplicate = selectedFiles.some(f => 
                    f.name === file.name && f.size === file.size
                );
                if (!isDuplicate) {
                    selectedFiles.push(file);
                }
            });
            
            updateFileInput();
            displayPreviews();
        });

        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => {
                dt.items.add(file);
            });
            imageInput.files = dt.files;
        }

        function displayPreviews() {
            previewContainer.innerHTML = '';
            
            if (selectedFiles.length === 0) {
                previewContainer.classList.add('hidden');
                return;
            }

            previewContainer.classList.remove('hidden');

            selectedFiles.forEach((file, index) => {
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative group';
                    
                    previewDiv.innerHTML = `
                        <div class="relative overflow-hidden rounded-lg border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                            <img src="${event.target.result}" 
                                    alt="Preview ${index + 1}" 
                                    class="w-full h-32 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity"></div>
                            <button type="button" 
                                    onclick="removeImage(${index})"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 truncate">${file.name}</p>
                    `;
                    
                    previewContainer.appendChild(previewDiv);
                };
                
                reader.readAsDataURL(file);
            });
        }

        function removeImage(index) {
            selectedFiles.splice(index, 1);
            updateFileInput();
            displayPreviews();
        }
    </script>
</x-app-layout>