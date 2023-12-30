@extends('layouts.app')

@section('content')
<div class="pt-[50px] h-screen w-full flex flex-col md:grid grid-cols-2 items-center">
    <h1 class="text-5xl text-black/50 font-bold tracking-wider text-center col-span-2 cursor-default py-8 md:py-0">
        {{$recipe['title']}}</h1>
    <!-- Left side -->
    <div class="flex flex-col items-center h-full">
        <div class="md:w-[400px] h-[400px] w-[300px] rounded-xl">
            <img src="{{ URL('storage/' . $recipe['image']) }}" alt="" class="w-full h-full object-cover rounded-xl">
        </div>
        <p>Created at {{ substr($recipe['created_at'], 0, 10) }} </p>
    </div>
    <!-- Right side -->
    <div class="h-full w-full">
        <div class="grid grid-cols-2 gap-4 mb-8 px-8">
            <p class="text-xl font-bold text-center">Preparation: <span
                    class="font-normal">{{$recipe['prep_time']}}</span></p>
            <p class="text-xl font-bold text-center">Cooking: <span class="font-normal">{{$recipe['cook_time']}}</span>
            </p>
            <p class="text-xl font-bold text-center">Servings: <span class="font-normal">{{$recipe['servings']}}</span>
            </p>
            <p class="text-xl font-bold text-center">Category: <span
                    class="font-normal">{{$recipe['category']['name']}}</span></p>
        </div>

        <p class="text-3xl text-center md:text-start font-bold col-span-2 pb-4">Ingredients: </p>
        <p class="text-xl font-normal pb-4 text-left px-8 md:px-0">{{$recipe['ingredients']}}</p>

        <p class="text-3xl text-center md:text-start font-bold col-span-2 pb-4">Instructions: </p>
        <p class="text-xl font-normal pb-4 px-8 md:px-0">{{ $recipe['instructions'] }}</p>

    </div>
</div>

@endsection