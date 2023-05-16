@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    <div class="py-5 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="md:w-1/2">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Update User</h3>
                    <form method="POST" action="{{ route('user.edit', $user->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div>
                            <label for="name">Name</label>
                            <x-text-input id="name" class="block mt-2" type="text" name="name" value="{{old('name', $user->name)}}" autofocus disabled/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Email Address -->
                        <div>
                            <label for="email">Email</label>
                            <x-text-input id="email" class="block mt-2" type="text" name="email" value="{{old('email', $user->email)}}" autofocus disabled/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Authorization Type -->
                        <div>
                            <label for="authorizationType">Authorization Type</label>
                            <select name="authorizationType" id="authorizationType" class="mt-2 w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="Admin" {{old('authorizationType', $user->authorizationType) === 'Admin' ? 'selected' : ''}}>Admin</option>
                                <option value="Verifier" {{old('authorizationType', $user->authorizationType) === 'Verifier' ? 'selected' : ''}}>Verifier</option>
                                <option value="Branch" {{old('authorizationType', $user->authorizationType) === 'Branch' ? 'selected' : ''}}>Branch</option>
                            </select>
                            <x-input-error :messages="$errors->get('authorizationType')" class="mt-2" />
                        </div>
                
                        <!-- Branch -->
                        <div>
                            <label for="branch_id">Branch</label>
                            <select name="branch_id" id="branch_id" class="mt-2 w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300">
                                <option value="" selected disabled hidden>Choose here</option>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}" {{old('branch_id', $user->branch_id) == $branch->id ? 'selected' : ''}}>{{$branch->key}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status">Status</label>
                            <select name="status" id="status" class="mt-2 w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="1" {{old('status', $user->status) ? 'selected' : ''}}>Active</option>
                                <option value="0" {{old('status', $user->status) ? '' : 'selected'}}>Inactive</option>
                            </select>
                            <x-input-error :messages="$errors->get('authorizationType')" class="mt-2" />
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
