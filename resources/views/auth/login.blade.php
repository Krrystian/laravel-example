@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center">
    <div
        class="w-full md:w-2/3 lg:w-1/3 h-3/7 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center">
        <h2 class="w-full text-3xl font-bold tracking-wide text-center pb-4">{{__('Login')}}</h2>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col">
            @csrf
            <!-- Email Address -->
            <!-- dyrektywa old przywraca pole dzieki temu podczas bledu uzytkowink nie musi wpisywac wszystkiego jeszcze raz-->
            <label for="email" class="text-xl relative mb-6">{{__('Email Address')}}
                <input id="email" type="email" class="w-full rounded-xl p-2 @error('email')
                 border-vanilla @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus>
                <!-- dyrektywa error sprawdza czy wystapil blad i jesli tak to wyswietla komunikat-->
                @error('email')
                <span class="absolute top-full left-0 text-vanilla text-sm md:text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <!-- Password -->
            <label for="password" class="text-xl mb-6">{{__('Password')}}
                <input id="password" type="password" class="w-full rounded-xl p-2 @error('password')
                 border-vanilla @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="absolute top-full left-0 text-vanilla text-sm md:text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>

            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked'
                        : '' }}>
                    <label for="remember">{{__('Remember Me')}}</label>
                </div>
                <!-- Forgot Password => Route to email.blade.php -->
                @if (Route::has('password.request'))
                <a class="text-vanilla hover:text-beige hover:scale-125 duration-300 transition-all text-right"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
            <button type="submit"
                class="w-full bg-vanilla rounded-xl p-2 mt-6 hover:bg-beige duration-300 transition-all">
                {{ __('Login') }}
            </button>
        </form>
    </div>
</div>
@endsection