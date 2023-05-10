@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="applicationWrap relative p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto mb-5">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Branch</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ date('F j, Y', strtotime($item->created_at)) }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->customers->fname . ' ' . $item->customers->lname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->branches->key }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
