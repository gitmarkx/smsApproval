@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    @if (session('application.created'))
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="mb-3 text-sm text-gray-600 dark:text-gray-400"
        >{{ __(session('application.created') . ' account has been successfully created!') }}</p>
    @endif
    <a href="{{ route('application.create') }}" class="block text-center w-fit px-4 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Create Application</a>
    <div class="my-5"></div>
    <div class="applicationWrap relative text-gray-900 dark:text-gray-100">
        <div class="relative overflow-x-auto mb-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">Date</th>
                        <th scope="col" class="px-2 py-3">Name</th>
                        <th scope="col" class="px-2 py-3">Branch</th>
                        <th scope="col" class="px-2 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ date('F j, Y', strtotime($item->created_at)) }}
                            </th>
                            <td class="px-2 py-4">
                                {{ $item->customers->fname . ' ' . $item->customers->lname }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $item->branches->key }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $item->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
@endsection
