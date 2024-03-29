@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center">
    <div
        class="w-full md:w-2/3 lg:w-1/3 h-3/7 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center">
        <h1 class="text-3xl text-center font-bold mb-4">Change Username</h1>
        <form action="{{ route('user.changeUsername') }}" method="POST">
            @csrf
            @method('PUT')
            <label for="username"
                class="text-xl flex text-center text-nowrap gap-4 items-center font-bold mb-4">{{__('New
                Username')}}
                <input id="username" type="text" class="w-full rounded-xl font-normal p-2 
                 border-vanilla " name="username" required autocomplete="username">
            </label>
            @error('username')
            <p class="text-vanilla text-sm md:text-base text-center w-full" role="alert">
                <strong>{{ $message }}</strong>
            </p>
            @enderror
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-vanilla w-full text-white text-xl font-bold py-2 px-4 rounded-lg hover:bg-beige duration-300 transition-all">Change</button>
            </div>
        </form>
    </div>
</div>
@endsection