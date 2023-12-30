@extends('layouts.app')

@section('content')
<form class="pt-[50px] h-screen w-full flex flex-col md:grid grid-cols-2 items-center px-16" method="PUT" action="">
    @csrf
    <label class="col-span-2 w-full flex justify-center" for="title">
        <input type="button" value="{{$recipe['title']}}" id="title" name="title" autocomplete autofocus required
            class="text-5xl border-2 border-sage rounded bg-beige text-black/50 font-bold tracking-wider text-center col-span-2 cursor-default py-8 md:py-0">
        </input>
    </label>
    <!-- Left side -->
    <div class="flex flex-col items-center justify-center h-full">
        <div class="md:w-[500px] md:h-[600px] h-[400px] w-[300px] rounded-xl">
            <img src="{{ URL('storage/default.png') }}" alt="" class="w-full shadow-2xl h-full object-cover rounded-xl">
        </div>
        <p>Created at {{ substr($recipe['created_at'], 0, 10) }} </p>
        <input id="image" type="button" value="Upload Image"></input>
    </div>
    <!-- Right side -->
    <div class="h-full w-full">
        <div class="grid grid-cols-2 gap-4 mb-8 px-8">
            <label class="text-xl font-bold text-center" for="prep_time">Preparation:
                <input id="prep_time" name="prep_time" class="font-normal border-2 border-sage bg-beige rounded"
                    value="{{$recipe['prep_time']}}" type="time" autocomplete autofocus />
            </label>
            <label class="text-xl font-bold text-center" for="cook_time">Cooking:
                <input id="cook_time" name="cook_time" class="font-normal border-2 border-sage bg-beige rounded"
                    value="{{$recipe['cook_time']}}" type="time" autocomplete autofocus />
            </label>
            <label class="text-xl font-bold text-center self-center" for="servings">Servings:
                <input id="servings" name="servings" class="font-normal border-2 border-sage bg-beige rounded"
                    value="{{$recipe['servings']}}" type="number" min="1" max="30" step="1" autocomplete autofocus />
            </label>
            <label class="text-xl font-bold text-center" for="category">Category:
                <select id="category" class="rounded-xl p-2 bg-beige border-sage border-2 " name="category" autocomplete
                    autofocus required>
                    <option value="" disabled selected>{{__('Select Category')}}</option>
                    @foreach ($categorySanitized as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <label for="ingredients"
            class="text-3xl text-center font-bold col-span-2 pb-4 flex flex-col justify-center">Ingredients:
            <textarea id="ingredients" name="ingredients"
                class="h-[200px] rounded-xl p-2 bg-beige text-xl font-normal border-sage border-2 resize-none"
                required>{{$recipe['ingredients']}}</textarea>
        </label>
        <label for="instructions"
            class="text-3xl text-center font-bold col-span-2 pb-4 flex flex-col justify-center">Instructions:
            <textarea id="instructions" name="instructions"
                class="h-[200px] w-full rounded-xl p-2 bg-beige text-xl font-normal border-sage border-2 resize-none"
                required>{{$recipe['instructions']}}</textarea>
        </label>
        <div class="flex justify-center gap-4">
            <button type="submit"
                class="text-3xl font-bold text-center rounded-xl p-2 bg-sage text-beige border-sage hover:bg-vanilla hover:text-black hover:border-vanilla duration-300 transition-all border-2">Save
                changes</button>
            <button type="button"
                class="text-3xl font-bold text-center rounded-xl p-2 bg-sage text-beige border-sage hover:bg-vanilla hover:text-black hover:border-vanilla duration-300 transition-all border-2">Delete
                Recipe</button>
        </div>
</form>

@endsection