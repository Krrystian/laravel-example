<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cooking Application</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

</head>

<body class="bg-beige">
    <nav class="bg-oldrose h-[50px] shadow-xl shadow-blue-200">
        <div class="flex justify-between items-center lg:px-6 px-3 h-full">
            <a class="text-2xl font-bold text-black" href="{{ url('/') }}">
                Cooking Book
            </a>
            <div class="flex text-xl h-full">
                @guest <!-- If the user is not logged in -->
                @if (Route::has('login'))
                <a href="{{ route('login') }}"
                    class="hover:bg-vanilla h-full px-4 flex items-center duration-300 transiiton-all">Login</a>
                @endif

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="hover:bg-vanilla h-full px-4 flex items-center duration-300 transiiton-all">
                    Register</a>
                @endif
                @endguest
            </div>
        </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>