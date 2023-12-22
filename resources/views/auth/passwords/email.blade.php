@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center">
    <div
        class="w-full md:w-2/3 lg:w-1/3 h-3/7 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center">
        <h2 class="w-full text-3xl font-bold tracking-wide text-center pb-4">{{__('Reset Password')}}</h2>
        <form method="POST" action="{{ config('mail.mailer') ? route('password.email') : '#' }}" class="flex flex-col">
            @csrf
            <!-- Email Address -->
            <!-- dyrektywa old przywraca pole dzieki temu podczas bledu uzytkowink nie musi wpisywac wszystkiego jeszcze raz-->
            <label for="email" class="text-xl relative mb-6">{{__('Email Address')}}
                <input id="email" type="email" class="w-full rounded-xl p-2 @error('email')
                 border-vanilla @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus>
                <!-- dyrektywa error sprawdza czy wystapil blad i jesli tak to wyswietla komunikat-->
                @error('email')
                <span class="absolute top-full left-0  text-vanilla text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <button type="submit" class="w-full bg-vanilla rounded-xl p-2  hover:bg-beige duration-300 transition-all">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>

        <!-- If the mailer is not configured, then show a warning -->
        @if (!config('mail.mailer'))
        <p class="text-beige mt-4">{{ __('The mailer is not configured. This project will not support mailing.') }}</p>
        @endif
    </div>
</div>
@endsection