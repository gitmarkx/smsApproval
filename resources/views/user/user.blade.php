@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative p-6 text-gray-900 dark:text-gray-100">
                    @if (session('user.created'))
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mb-3 text-sm text-gray-600 dark:text-gray-400"
                        >{{ __(session('user.created') . ' account has been successfully created!') }}</p>
                    @endif
                    @if (session('user.updated'))
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mb-3 text-sm text-gray-600 dark:text-gray-400"
                        >{{ __(session('user.updated') . ' account has been updated!') }}</p>
                    @endif
                    <a href="{{ route('user.create') }}" class="block text-center w-fit px-4 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Create User</a>
                    <div class="my-5"></div>
                    <div class="overflow-x-auto">
                        <table class="border-collapse table-auto snap-x w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Name</th>
                                    <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Email</th>
                                    <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Authorization</th>
                                    <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800">
                                @foreach ($users as $user)
                                    <tr onclick="window.location = '{{route('user.show', $user->id)}}'" class="hover:cursor-pointer hover:bg-slate-100">
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{$user->name}}</td>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{$user->email}}</td>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{$user->authorizationType}}</td>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4 px-2 dark:text-slate-400">
                                            {{
                                                $user->status ? 'Active' : 'Inactive'; 
                                            }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
