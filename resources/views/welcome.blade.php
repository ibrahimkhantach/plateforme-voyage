<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Horizons Infinis</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

      
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-800 dark:text-white dark:bg-gray-900">
        <header>
            <x-navbar/>
        </header>
        <main>

            

            
            <x-aventure.all-aventure :aventures="$aventures" />
            
        </main>
        
    </body>
</html>

