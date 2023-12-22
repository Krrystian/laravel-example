@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center">
    <div
        class="w-full md:w-2/3 lg:w-1/3 h-3/7 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center">
        <h2 class="w-full text-3xl font-bold tracking-wide text-center pb-4">{{__('Register')}}</h2>
        <form method="POST" action="{{ route('register') }}" class="flex flex-col">
            @csrf
            <!-- Name -->
            <!-- dyrektywa old przywraca pole dzieki temu podczas bledu uzytkowink nie musi wpisywac wszystkiego jeszcze raz-->
            <label for="name" class="text-xl relative mb-6">{{__('Name')}}
                <input id="name" type="text" class="w-full rounded-xl p-2 @error('name')
                 border-vanilla @enderror" name="name" value="{{ old('name') }}" required autocomplete="name"
                    autofocus>
                <!-- dyrektywa error sprawdza czy wystapil blad i jesli tak to wyswietla komunikat-->
                @error('name')
                <span class="absolute top-full left-0  text-vanilla text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <!-- Email Address -->
            <label for="email" class="text-xl relative mb-6">{{__('Email Address')}}
                <input id="email" type="email" class="w-full rounded-xl p-2 @error('email')
                 border-vanilla @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus>
                @error('email')
                <span class="absolute top-full left-0  text-vanilla text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <!-- Password -->
            <label for="password" class="text-xl mb-6 relative">{{__('Password')}}
                <input id="password" type="password" class="w-full rounded-xl p-2 @error('password')
                 border-vanilla @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="absolute top-full left-0 text-vanilla md:text-base text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <!-- Confirm Password -->
            <label for="password-confirm" class="text-xl mb-8">{{__('Confirm Password')}}
                <input id="password-confirm" type="password" class="w-full rounded-xl p-2" name="password_confirmation"
                    required autocomplete="new-password">
            </label>
            <button type="submit" class="w-full bg-vanilla rounded-xl p-2 hover:bg-beige duration-300 transition-all">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</div>
@endsection