@extends('layouts.app')

@section('content')
<div class="relative w-full h-screen justify-center items-center overflow-x-hidden">
    <!-- Left -->
    <div
        class="hidden fixed z-10 w-[300px] h-[93vh] top-[7vh] md:flex bg-buff overflow-hidden justify-center items-center">
        <div class="w-full h-full overflow-y-scroll px-4">
            @auth
            <a class="hidden md:block mt-4 w-full text-center bg-sage hover:bg-vanilla duration-300 transition-all p-2 rounded font-bold text-xl"
                href="{{ route('recipe.create') }}">
                Create new
            </a>
            @endauth
            <form action="{{route('search')}}" method="GET" class="relative">
                @csrf
                <input type="text" id="title" name="title" placeholder="Search by title"
                    class="bg-vanilla flex w-full p-2 placeholder:text-center placeholder:text-black pr-8 font-bold text-center text-xl my-4 placeholder:font-bold rounded"></input>
                <button class="absolute right-0 top-0 translate-y-[80%] -translate-x-[40%]"
                    type="submit"><x-bi-search /></button>
            </form>
            <div class="flex items-center">
                <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 border-vanilla cursor-default">
                    Categories</h1>
            </div>
            <div class="mt-4">
                <ul class="space-y-2">
                    @foreach($categorySanitized as $id => $name)
                    <li class="flex justify-between items-center">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => $id]) }}">
                            {{$name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 pt-4 border-vanilla cursor-default">
                    Filter by</h1>
            </div>
            <div class="mt-4">
                <ul class="space-y-2">
                    <li class="flex justify-between items-center">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => 'newest']) }}">
                            The newest recipes
                        </a>
                    </li>
                    <li class="flex justify-between items-center">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => 'longest']) }}">
                            The longest preparation time
                        </a>
                    </li>
                    <li class="flex justify-between items-center pb-4">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => 'loved']) }}">
                            The most loved ones
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="filterMenu"
        class="md:hidden absolute w-full top-[50px] min-h-[10%] grid grid-cols-2 overflow-hidden justify-center items-center gap-2 px-2">
        <button class="w-full bg-buff hover:bg-vanilla font-bold py-2 px-8 rounded duration-300 transition-all"
            id="toggleFilter">
            Filter
        </button>
        @auth
        <a class="w-full bg-buff hover:bg-vanilla font-bold py-2 px-8 rounded duration-300 text-center transition-all cursor-pointer"
            href="{{ route('recipe.create') }}" id="filterCreateNew">
            Create new
        </a>
        @endauth
    </div>
    <div id="filterDropdown"
        class="flex fixed z-10 w-[50%] h-[93vh] top-[7vh] pt-[75px] bg-buff overflow-hidden justify-center items-center -translate-x-[100%] duration-300 transition-all">
        <div class="w-full h-full overflow-y-scroll px-3">
            <form action="{{route('search')}}" method="GET" class="relative">
                @csrf
                <input type="text" id="title" name="title" placeholder="Search by title"
                    class="bg-vanilla flex w-full p-2 placeholder:text-center placeholder:text-black pr-8 font-bold text-center text-xl my-4 placeholder:font-bold rounded"></input>
                <button class="absolute right-0 top-0 translate-y-[80%] -translate-x-[40%]"
                    type="submit"><x-bi-search /></button>
            </form>
            <div class="flex items-center">
                <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 border-vanilla cursor-default">
                    Categories</h1>
            </div>
            <div class="mt-4">
                <ul class="space-y-2">
                    @foreach($categorySanitized as $id => $name)
                    <li class="flex justify-between items-center">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => $id]) }}">
                            {{$name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 pt-4 border-vanilla cursor-default">
                    Filter by</h1>
            </div>
            <div class="mt-4">
                <ul class="space-y-2">
                    <li class="flex justify-between items-center">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => 'newest']) }}">
                            The newest recipes
                        </a>
                    </li>
                    <li class="flex justify-between items-center">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => 'longest']) }}">
                            The longest preparation time
                        </a>
                    </li>
                    <li class="flex justify-between items-center pb-4">
                        <a class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all"
                            href="{{ route('filter', ['category' => 'loved']) }}">
                            The most loved ones
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Right -->
    <div class="w-full md:pl-[300px] pt-[120px] md:pt-[50px] min-h-full">
        <div class="flex flex-row p-4 md:p-8 gap-8 flex-wrap w-full justify-center">
            @foreach($recipes as $recipe)
            <div class="bg-oldrose p-4 min-w-[300px] w-[200px] rounded-xl hover:bg-vanilla hover:shadow-2xl duration-300 cursor-pointer"
                onclick="window.location.href='{{ route('recipe.show', ['recipe' => $recipe['id']]) }}'">
                <h1 class="text-2xl font-bold text-center pb-2">
                    {{$recipe['title']}}
                </h1>
                <!--IMAGE-->
                <img src="{{ URL('storage/' . $recipe['image']) }}" alt="recipe image"
                    class="w-full h-[200px] rounded-xl">
                <div class="flex justify-between">
                    <p>
                        <span class="font-bold">Preparation:</span> {{ $recipe['prep_time']}}
                    </p>
                    <p class="text-right">
                        <span class="font-bold">Cooking:</span> {{$recipe['cook_time']}}
                    </p>
                </div>
                <p class="h-[75px]">
                    {{ strlen($recipe['instructions']) > 75 ? substr($recipe['instructions'], 0, 75) . '...' :
                    $recipe['instructions'] }}
                </p>
                <div class="w-full flex flex-row gap-1">
                    @auth
                    @if(!in_array(Auth::user()->id, $recipe['likes']))
                    <form method="POST" action="{{ route('recipe.like', ['recipe' => $recipe['id']]) }}" class="flex">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="h-5 w-5 text-black self-center">
                            <x-heroicon-o-heart />
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('recipe.like', ['recipe' => $recipe['id']]) }}" class="flex">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="h-5 w-5 text-black self-center">
                            <x-heroicon-s-heart />
                        </button>
                    </form>
                    @endif
                    @else
                    <x-heroicon-o-heart class="h-5 w-5 text-black self-center" />
                    @endauth
                    <p>
                        {{count($recipe['likes'])}}
                    </p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <script>
        function toggleFilter() {
            const filter = document.getElementById('filterDropdown');
            const toggleFilter = document.getElementById('toggleFilter');
            const filterMenu = document.getElementById('filterMenu');
            filter.classList.toggle('-translate-x-[100%]');
            toggleFilter.classList.toggle('bg-buff');
            toggleFilter.classList.toggle('bg-vanilla');
            filterMenu.classList.toggle('z-30');
        }
        if (element = document.getElementById('toggleFilter')) {
            element.addEventListener('click', function () {
                toggleFilter();
            });
        }
    </script>
    @endsection