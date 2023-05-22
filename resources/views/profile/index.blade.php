@extends('layouts.app')

@section('content')
    <div class="p-4 sm:p-8 mb-5 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        @include('profile.partials.update-profile')
    </div>
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        @include('profile.partials.update-password')
    </div>
@endsection