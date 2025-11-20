<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Aventure</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-10">
    @if(session("success"))
    <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 rounded shadow-md mb-4" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
        </svg>
        <p>{{ session("success") }}</p>
    </div>
@endif
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Add New Aventure</h2>

        <form action="{{ route("aventure.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                <input type="text" name="destination" id="destination" value="{{ old('destination') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('destination')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                <textarea name="details" id="details" rows="4" 
                          class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('details') }}</textarea>
                @error('details')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Images (Select multiple)</label>
                
                <!-- File Input with improved styling -->
                <div class="relative">
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                           class="mt-1 block w-full rounded-md border border-gray-300 p-2 text-sm text-gray-500 
                                  file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                  file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 
                                  hover:file:bg-indigo-100 cursor-pointer">
                </div>

                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Image Preview Container -->
                <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4 hidden">
                    <!-- Previews will be inserted here by JavaScript -->
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Entry
                </button>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('images');
        const previewContainer = document.getElementById('imagePreviewContainer');
        let selectedFiles = [];

        imageInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            
            // Add new files to existing files instead of replacing
            newFiles.forEach(file => {
                // Avoid duplicates based on name and size
                const isDuplicate = selectedFiles.some(f => 
                    f.name === file.name && f.size === file.size
                );
                if (!isDuplicate) {
                    selectedFiles.push(file);
                }
            });
            
            // Update the file input with all selected files
            updateFileInput();
            
            // Display all previews
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
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (selectedFiles.length === 0) {
                previewContainer.classList.add('hidden');
                return;
            }

            previewContainer.classList.remove('hidden');

            selectedFiles.forEach((file, index) => {
                // Only process image files
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative group';
                    
                    previewDiv.innerHTML = `
                        <div class="relative overflow-hidden rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition-colors">
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
                        <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                    `;
                    
                    previewContainer.appendChild(previewDiv);
                };
                
                reader.readAsDataURL(file);
            });
        }

        // Function to remove individual images
        function removeImage(index) {
            selectedFiles.splice(index, 1);
            updateFileInput();
            displayPreviews();
        }
    </script>

</body>
</html>