<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Renew my Mind</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <nav class="flex items-center min-h-12 bg-gray-100 px-4 py-2 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Renew my Mind</h3>
    </nav>

    
    <main class="min-h-screen flex flex-col items-center justify-center">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>