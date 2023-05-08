@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    <div class="py-5 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="md:w-1/2">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Create User</h3>
                    <form method="POST" action="{{ route('user.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name">Name</label>
                            <x-text-input id="name" class="block mt-2" type="text" name="name" value="{{old('name')}}" autofocus/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Email Address -->
                        <div>
                            <label for="email">Email</label>
                            <x-text-input id="email" class="block mt-2" type="text" name="email" value="{{old('email')}}" autofocus/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                
                        <!-- Authorization Type -->
                        <div>
                            <label for="authorizationType">Authorization Type</label>
                            <select name="authorizationType" id="authorizationType" class="mt-2 w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="Admin" {{old('authorizationType') === 'Admin' ? 'selected' : ''}}>Admin</option>
                                <option value="Verifier" {{old('authorizationType') === 'Verifier' ? 'selected' : ''}}>Verifier</option>
                                <option value="Branch" {{old('authorizationType') === 'Branch' ? 'selected' : ''}}>Branch</option>
                            </select>
                            <x-input-error :messages="$errors->get('authorizationType')" class="mt-2" />
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password">Password</label>
                            <x-text-input id="password" class="block mt-2" type="password" name="password" value="{{old('password')}}" autofocus/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation">Confirm Password</label>
                            <x-text-input id="password_confirmation" class="block mt-2" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" autofocus/>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                
                        <div class="">
                            <x-primary-button class="mr-5 w-24">Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
