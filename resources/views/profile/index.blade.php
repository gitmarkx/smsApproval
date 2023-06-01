@extends('layouts.app')

@section('content')
    <div class="mb-10 dark:bg-gray-800">
        @include('profile.partials.update-profile')
    </div>
    <div class="dark:bg-gray-800">
        @include('profile.partials.update-password')
    </div>
@endsection