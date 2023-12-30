@extends('layouts.app')

@section('content')
<div class="relative w-full h-screen justify-center items-center overflow-x-hidden">
    <!-- Left -->
    @auth
    <a class="hidden md:block fixed top-[75px] max-w-[300px] z-20 left-[150px] -translate-x-[50%] text-center bg-sage hover:bg-vanilla font-bold rounded-md py-2 px-4 duration-300 transition-all cursor-pointer"
        href="{{ route('recipe.create') }}">
        Create new
    </a>
    @endauth
    <div
        class="hidden fixed z-10 w-[300px] top-[50px] min-h-screen md:flex bg-buff overflow-hidden justify-center items-center p-4">
        <div class="w-full">
            <div class="flex justify-between items-center">
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
        </div>
    </div>
    <div id="filterMenu"
        class="md:hidden absolute w-full top-[50px] min-h-[10%] grid grid-cols-2 overflow-hidden justify-center items-center p-4 gap-4">
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
        class="fixed flex-col p-4 justify-center bg-buff flex pt-[50px] h-screen z-10 top-[50px] w-1/2 overflow-hidden duration-300 transition-all -translate-x-[100%]">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 border-vanilla cursor-default">
                Categories</h1>
        </div>
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
                <p>
                    {{ strlen($recipe['instructions']) > 100 ? substr($recipe['instructions'], 0, 100) . '...' :
                    $recipe['instructions'] }}
                </p>
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