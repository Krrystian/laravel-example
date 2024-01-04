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
    <nav class="fixed z-10 w-full bg-oldrose h-[7vh] shadow-xl ">
        <div class="flex justify-between items-center lg:px-6 px-3 h-full">
            <!-- Logo -->
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
                @else <!-- If the user is logged in -->
                <div class="relative flex">
                    <h1 class="h-full md:flex items-center cursor-default pr-12 hidden">Welcome, <span
                            class="px-3 font-bold">{{
                            Auth::user()->name
                            }}</span></h1>
                    <div id="menuToggle" class="absolute right-0 cursor-pointer h-full flex items-center">
                        <x-coolicon-hamburger-md id="hamburger" class=" w-[40px] " />
                        <x-grommet-close id="close-hamburger" class="-translate-x-1 w-[30px] hidden " />
                    </div>
                </div>
                @endguest
            </div>
        </div>
        <!-- Dropdown -->
        <div id="dropdown"
            class="fixed flex flex-col select-none gap-4 h-full bg-buff w-[300px] p-4 top-[7vh] right-0 duration-500 transition-all translate-x-[300px]">
            @if (Route::has('user'))
            <a href=" {{ route('user') }}"
                class="hover:bg-vanilla hover:rounded-xl h-[100px] px-4 flex items-center duration-300 justify-center transiiton-all text-2xl tracking-wider font-bold  border-b-2 border-b-vanilla ">
                My Profile
            </a>
            @endif
            <a href=" {{ route('user.changeUsername') }}"
                class="hover:bg-vanilla hover:rounded-xl h-[100px] px-4 flex items-center duration-300 justify-center transiiton-all text-2xl tracking-wider font-bold  border-b-2 border-b-vanilla ">
                Change Username
            </a>
            @if (Route::has('logout'))
            <div>
                <a href=" {{ route('logout') }}"
                    class="hover:bg-vanilla hover:rounded-xl h-[100px] text-red px-4 flex items-center duration-300 justify-center transiiton-all text-2xl tracking-wider font-bold  border-b-2 border-b-vanilla "
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
            @endif

        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
<script>
    const dropdown = () => {
        const hamburgerIcon = document.getElementById('hamburger');
        const closeIcon = document.getElementById('close-hamburger');
        const dropdown = document.getElementById('dropdown');

        hamburgerIcon.classList.toggle('hidden'); //hamburger icon
        dropdown.classList.toggle('translate-x-0'); //dropdown animation
        dropdown.classList.toggle('translate-x-[300px]'); //dropdown animation
        closeIcon.classList.toggle('hidden'); //close icon
    }
    let element;
    if (element = document.getElementById('menuToggle')) {
        element.addEventListener('click', function () {
            dropdown();
        });
    }

</script>

</html>