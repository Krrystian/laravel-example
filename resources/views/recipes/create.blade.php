@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center">
    <div
        class="w-full md:w-2/3 lg:w-1/3 h-3/7 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center">
        <h2 class="w-full text-3xl font-bold tracking-wide text-center pb-4">{{__('Create Recipe')}}</h2>
        <form method="POST" action="{{ route('recipe.store') }}" class="flex flex-col">
            @csrf
            <!-- Name -->
            <label for="name" class="text-xl relative mb-6">{{__('Name')}}
                <input id="name" type="text" class="w-full rounded-xl p-2 @error('name')
                 border-vanilla @enderror" name="name" value="{{ old('name') }}" required autocomplete="name"
                    autofocus>
                @error('name')
                <span class="absolute top-full left-0 text-vanilla text-sm md:text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <!-- Description -->
            <label for="description" class="text-xl relative mb-6">{{__('Description')}}
                <textarea id="description" type="text" class="w-full rounded-xl p-2 @error('description')
                border-vanilla @enderror" name="description" value="{{ old('description') }}" required
                    style="max-height: 15em; resize: vertical;"></textarea>
                @error('description')
                <span class="absolute top-full left-0 text-vanilla text-sm md:text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <label for="category" class="text-xl relative mb-6">{{__('Category')}}
                <select id="category" type="text" class="w-full rounded-xl p-2 @error('category')
                 border-vanilla @enderror" name="category" value="{{ old('category') }}" required
                    autocomplete="category" autofocus>
                    @foreach($categorySanitized as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
                @error('category')
                <span class="absolute top-full left-0 text-vanilla text-sm md:text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </form>
    </div>
</div>
@endsection