@extends('layouts.guest')

@section('content')

    <form method="POST" action="{{ route('auth') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <x-text-input id="email" class="block mt-2" type="text" name="email" value="{{old('email')}}" autofocus/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <x-text-input id="password" class="block mt-2" type="password" name="password" value="{{old('password')}}" autofocus/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <x-primary-button class="mt-5">Login</x-primary-button>
        
        @if (session()->has('message'))
            <small class="block mt-3 text-red-500">{{session('message')}}</small>
        @endif
    </form>
@endsection
