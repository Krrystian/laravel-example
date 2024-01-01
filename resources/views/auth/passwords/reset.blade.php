@extends('layouts.app')

@section('content')
<div class="w-full h-screen flex items-center justify-center">
    <div
        class="w-full md:w-2/3 lg:w-1/3 h-3/7 rounded-xl bg-oldrose m-4 md:m-0 p-8 md:shadow-2xl shadow-oldrose flex flex-col justify-center">
        <h2 class="w-full text-3xl font-bold tracking-wide text-center pb-4">{{__('Reset Password')}}</h2>
        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
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
            <label for="password" class="text-xl relative mb-6">{{__('Password')}}
                <input id="password" type="password" class="w-full rounded-xl p-2 @error('password')
                 border-vanilla @enderror" name="password" value="{{ old('password') }}" required
                    autocomplete="new-password" autofocus>
                @error('password')
                <span class="absolute top-full left-0  text-vanilla text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <label for="password-confirm" class="text-xl relative mb-6">{{__('Confirm Password')}}
                <input id="password-confirm" type="password" class="w-full rounded-xl p-2 @error('password')
                 border-vanilla @enderror" name="password_confirmation" value="{{ old('password') }}" required
                    autocomplete="new-password" autofocus>
                @error('confirm_password')
                <span class="absolute top-full left-0  text-vanilla text-base" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>

            <button type="submit" class="w-full bg-vanilla rounded-xl p-2  hover:bg-beige duration-300 transition-all">
                {{ __('Reset Password') }}
            </button>
        </form>
    </div>
</div>
@endsection