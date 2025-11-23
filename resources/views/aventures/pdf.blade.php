<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Adventures Export</title>
    <style>
        body { font-family: sans-serif; }
        .page-break { page-break-after: always; }
        .adventure-container { margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 20px; }
        
        /* Grid for images */
        .img-wrapper { 
            display: inline-block; 
            width: 30%; 
            margin: 1.5%; 
            vertical-align: top; 
            text-align: center;
        }
        .pdf-image { 
            width: 100%; 
            height: 120px; 
            object-fit: cover; 
            border: 1px solid #999; 
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Adventures for {{ $user->name }}</h1>

    @foreach($aventures as $adventure)
        <div class="adventure-container">
            <h2>{{ $adventure->title }}</h2>
            <p><strong>Destination:</strong> {{ $adventure->destination }}</p>
            <p>{{ $adventure->details }}</p>

            <div style="margin-top: 20px;">
                {{-- 
                    LOGIC: The DB only has the folder name.
                    We must scan the folder to find the files.
                --}}
                @php
                    // 1. Get folder name from DB (e.g. "adventures/15")
                    $folderName = $adventure->images; 

                    // 2. Initialize empty array
                    $files = [];

                    // 3. Scan the folder if it exists
                    if ($folderName && \Illuminate\Support\Facades\Storage::disk('public')->exists($folderName)) {
                        $files = \Illuminate\Support\Facades\Storage::disk('public')->files($folderName);
                    }
                @endphp

                {{-- 4. Loop through the found files --}}
                @if(count($files) > 0)
                    <strong>Gallery:</strong><br>
                    @foreach($files as $filePath)
                        <div class="img-wrapper">
                            {{-- 
                                IMPORTANT: DomPDF needs the PHYSICAL path (C:\xampp\...)
                                'storage/' . $filePath converts "adventures/15/img.jpg" to "storage/adventures/15/img.jpg"
                            --}}
                            <img src="{{ public_path('storage/' . $filePath) }}" class="pdf-image">
                        </div>
                    @endforeach
                @else
                    <p style="font-size:10px; color:gray;">(No images found in folder)</p>
                @endif
            </div>
        </div>

        {{-- Page break for next adventure --}}
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>