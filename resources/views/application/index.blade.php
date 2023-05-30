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
    @if (session('application.deleted'))
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="mb-3 text-sm text-gray-600 dark:text-gray-400"
        >{{ __(session('application.deleted')) }}</p>
    @endif
    @if (session('application.canceled'))
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="mb-3 text-sm text-gray-600 dark:text-gray-400"
        >{{ __(session('application.canceled')) }}</p>
    @endif
    <a href="{{ route('application.create') }}" class="block text-center w-fit px-4 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Create Application</a>
    <div class="my-5"></div>
    <div class="applicationWrap relative text-gray-900 dark:text-gray-100">
        <div class="relative overflow-x-auto mb-5">
            @if (count($applications) > 0)
            <table class="appTable border border-collapse table-auto snap-x w-full text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Date</th>
                        <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Name</th>
                        <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Branch</th>
                        <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Status</th>
                        <th class="border-b dark:border-slate-600 font-medium py-4 px-2 dark:text-slate-200 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    @foreach ($applications as $item)
                        <tr class="hover:bg-slate-100">
                            <td class="border-b dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{date('F d, Y', strtotime($item->created_at))}}</td>
                            <td class="border-b dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{$item->customer->lname}}, {{$item->customer->fname}} {{$item->customer->mname}}</td>
                            <td class="border-b dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{$item->branch->key}}</td>
                            <td class="border-b dark:border-slate-700 py-4 px-2 dark:text-slate-400">{{$item->status}}</td>
                            <td class="border-b dark:border-slate-700 py-4 px-2 dark:text-slate-400 flex">
                                <a href="{{route('application.show', $item->id)}}" class="a bg-indigo-700 text-white p-1 rounded-md mr-2">View</a>
                                @if (auth()->user()->authorizationType === 'B')
                                    <form method="POST" action="{{route('application.destroy', $item->id)}}" id="formDeleteApp" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-700 text-white p-1 rounded-md mr-2">Delete</button>
                                    </form>
                                    @if ($item->status != 'Canceled')
                                        <form method="POST" action="{{route('application.cancel', $item->id)}}" id="formCancelApp" >
                                            @csrf
                                            <button type="submit" class="bg-red-700 text-white p-1 rounded-md">Cancel</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No data available!</p>
            @endif
        </div>
        {{ $applications->links() }}
    </div>
@endsection
