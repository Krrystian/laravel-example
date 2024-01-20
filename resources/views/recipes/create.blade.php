@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center pt-[10vh]">
    <div
        class="w-full md:w-2/3 py-8 lg:w-2/3 xl:w-3/5 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center overflow-y-scroll">
        <h2 class="w-full text-3xl font-bold tracking-wide text-center pb-4">{{__('Create Recipe')}}</h2>
        <form method="POST" enctype="multipart/form-data" action="{{ route('recipe.store') }}"
            class="flex flex-col md:grid md:grid-cols-2 gap-x-8">
            @csrf
            <label for="title"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 col-span-2 text-center h-full justify-center items-center md:border-b-2 border-vanilla">{{__('Title')}}
                <input id="title" type="text" class="w-full rounded-xl p-2 @error('title')
                 border-vanilla @enderror" name="title" value="{{ old('title') }}" required autocomplete="title"
                    autofocus>
            </label>

            <label for="prep_time"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 text-center h-full justify-center items-center">{{__('Prep
                Time')}}
                <input id="prep_time" type="time" class="rounded-xl p-2 @error('prep_time')
                 border-vanilla @enderror" name="prep_time" value="{{ old('prep_time') }}" required
                    autocomplete="prep_time" autofocus>
            </label>

            <label for="cook_time"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 text-center h-full justify-center items-center">{{__('Cook
                Time')}}
                <input id="cook_time" type="time" class="rounded-xl p-2 @error('cook_time')
                 border-vanilla @enderror" name="cook_time" value="{{ old('cook_time') }}" required
                    autocomplete="cook_time" autofocus>
            </label>

            <label for="servings"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 text-center h-full justify-center items-center">{{__('Servings')}}
                <input id="servings" type="number" min="1" max="30" step="1" class="rounded-xl p-2 @error('servings')
                 border-vanilla @enderror" name="servings" value="{{ old('servings') }}" required
                    autocomplete="servings" autofocus>
            </label>

            <label for="category"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 text-center h-full justify-center items-center">{{__('Category')}}
                <select id="category" class="w-full rounded-xl p-2 @error('category')
                border-vanilla @enderror" name="category" required>
                    <option value="" disabled selected>{{__('Select Category')}}</option>
                    @foreach ($categorySanitized as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </label>

            <label for="ingredients"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 col-span-2 text-center h-full justify-center items-center md:border-t-2 border-vanilla">{{__('Ingredients')}}
                <textarea id="ingredients" class="w-full rounded-xl p-2 @error('ingredients')
                border-vanilla @enderror" name="ingredients" required
                    style="max-height: 6em; resize: vertical;">{{ old('ingredients') }}</textarea>
            </label>

            <label for="instructions"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 col-span-2 text-center h-full justify-center items-center">{{__('Instructions')}}
                <textarea id="instructions" class="w-full rounded-xl p-2 @error('instructions')
                border-vanilla @enderror" name="instructions" required
                    style="max-height: 6em; resize: vertical;">{{ old('instructions') }}</textarea>
            </label>
            <label for="image"
                class="text-xl font-bold relative gap-6 mb-6 grid grid-cols-2 col-span-2 text-center h-full justify-center items-center">{{__('Image')}}
                <input id="image" type="file" class="w-full rounded-xl p-2 @error('image')
                border-vanilla @enderror" name="image" value="{{ old('image') }}" required autocomplete="image"
                    autofocus>
            </label>
            @if($errors->any())
            <p class="text-vanilla text-xs md:text-base font-bold mb-2 text-center w-full col-span-2" role="alert">
                <strong>{{ $errors->first() }}</strong>
            </p>
            @endif
            <div class="col-span-2 mb-4 flex w-full gap-4 pb-1">
                <a href="{{ route('home')}}"
                    class="bg-vanilla text-white rounded-xl text-xl px-4 py-2 w-full h-full hover:bg-beige duration-300 transition-all text-center flex justify-center items-center">{{__('Back')}}</a>
                <button type="submit"
                    class="bg-vanilla text-white rounded-xl text-xl px-4 py-2 w-full h-full hover:bg-beige duration-300 transition-all">{{__('Create')}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection