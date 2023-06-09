@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    <div class="md:w-1/2">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Create Branch</h3>
        <form method="POST" action="{{ route('branch.store') }}" class="mt-6 space-y-6">
            @csrf
            <!-- Key -->
            <div>
                <label for="key">Key</label>
                <x-text-input id="key" class="block mt-2" type="text" name="key" value="{{old('key')}}" autofocus/>
                <x-input-error :messages="$errors->get('key')" class="mt-2" />
            </div>

            <!-- Description -->
            <div>
                <label for="description">Description</label>
                <x-text-input id="description" class="block mt-2" type="text" name="description" value="{{old('description')}}" autofocus/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
    
            <div class="">
                <x-primary-button class="mr-5 w-24">Save</x-primary-button>
            </div>
        </form>
    </div>
@endsection
