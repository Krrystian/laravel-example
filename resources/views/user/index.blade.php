@extends('layouts.app')

@section('content')

<div class="relative w-full h-screen justify-center items-center overflow-x-hidden">
    <!-- Left -->
    @auth
    <div class="w-[300px] flex justify-center p-4">
        <a class="hidden md:flex w-full justify-center fixed top-[75px] max-w-[268px] z-20 text-center bg-sage hover:bg-vanilla font-bold rounded py-2 px-8 text-xl my-2 duration-300 transition-all"
            href="{{ route('recipe.create') }}">
            Create new
        </a>
    </div>

    @endauth
    <div
        class="hidden fixed z-10 w-[300px] top-[7vh] min-h-[93vh] md:flex bg-buff overflow-hidden justify-center items-center p-4">

        <div class="w-full">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 border-vanilla cursor-default">
                    My Profile</h1>
            </div>
            <div class="mt-4">
                <ul class="space-y-2">
                    <!-- ADD PROFILE INFORMATION -->
                    <li><span class="font-bold">Total recipes:</span> {{ count($recipes) }}</li>
                    <li><span class="font-bold">Email: </span>{{Auth::user()->email}}</li>
                    <li><span class="font-bold">Username: </span>{{Auth::user()->name}}</li>
                    <li><span class="font-bold">Created account:</span> {{
                        \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="profileMenu"
        class="md:hidden absolute w-full top-[50px] min-h-[10%] grid grid-cols-2 overflow-hidden justify-center items-center p-4 gap-4">
        <button class="w-full bg-buff hover:bg-vanilla font-bold py-2 px-8 rounded duration-300 transition-all"
            id="toggleProfile">
            Profile
        </button>
        @auth
        <a class="w-full bg-buff hover:bg-vanilla font-bold py-2 px-8 rounded duration-300 text-center transition-all cursor-pointer"
            href="{{ route('recipe.create') }}" id="filterCreateNew">
            Create new
        </a>
        @endauth
    </div>
    <div id="profileDropdown"
        class="fixed flex-col p-4 justify-center bg-buff flex pt-[7vh] h-[93vh] z-10 top-[7vh] w-1/2 overflow-hidden duration-300 transition-all -translate-x-[100%]">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 border-vanilla cursor-default">
                My Profile</h1>
        </div>
        <ul class="space-y-2">
            <!-- ADD PROFILE INFORMATION -->
            <li><span class="font-bold">Total recipes:</span> {{ count($recipes) }}</li>
            <li><span class="font-bold">Email: </span>{{Auth::user()->email}}</li>
            <li><span class="font-bold">Username: </span>{{Auth::user()->name}}</li>
            <li><span class="font-bold">Created account:</span> {{
                \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</li`>
        </ul>
    </div>
    <!-- Right -->
    <div class="w-full md:pl-[300px] pt-[120px] md:pt-[50px] min-h-full">
        <div class="flex flex-row p-4 md:p-8 gap-8 flex-wrap w-full justify-center">
            @foreach($recipes as $recipe)
            <div class="bg-oldrose p-4 min-w-[300px] w-[200px] rounded-xl hover:bg-vanilla hover:shadow-2xl duration-300 cursor-pointer"
                onclick="window.location.href='{{ route('recipe.edit', ['recipe' => $recipe['id']]) }}'">
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
                    {{ strlen($recipe['instructions']) > 75 ? substr($recipe['instructions'], 0, 75) . '...' :
                    $recipe['instructions'] }}
                </p>
            </div>
            @endforeach

        </div>
    </div>
    <script>
        function toggleProfile() {
            const profile = document.getElementById('profileDropdown');
            const toggleProfile = document.getElementById('toggleProfile');
            const profileMenu = document.getElementById('profileMenu');
            profile.classList.toggle('-translate-x-[100%]');
            toggleProfile.classList.toggle('bg-buff');
            toggleProfile.classList.toggle('bg-vanilla');
            profileMenu.classList.toggle('z-30');
        }
        if (element = document.getElementById('toggleProfile')) {
            element.addEventListener('click', function () {
                toggleProfile();
            });
        }
    </script>

    @endsection