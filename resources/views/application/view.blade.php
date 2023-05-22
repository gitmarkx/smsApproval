@extends('layouts.app')
@section('content')
    {{-- {{$application}} --}}
    <div class="w-full relative">
        <div class="flex flex-wrap">
            <div class="imgWrap pr-5 lg:lg:w-1/2">
                <div class="w-full">
                    <a class="mr-3" id="btnStatusLog">Status Logs</a>
                    <a href="">Upload Documents</a>
                </div>
                <div class="">
                    <ul class="flex flex-wrap border p-3 mt-3"> 
                        @foreach ($images as $image)
                            <li class="w-14 mr-3">
                                <img class="aspect-square object-cover" src="{{ asset('storage/'.$image->imgSrc.'') }}" alt="Image">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="appInfo lg:lg:w-1/2">
                <ul class="flex flex-wrap">
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Date:</p>
                        {{$application->created_at->format('F d, Y')}}
                    </li>
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Application Type:</p>
                        {{$application->transactionType ? 'Reapplication' : 'New Application'}}
                    </li>
                    <li class="w-full mb-2">
                        <p class="font-bold">Name:</p>
                        {{$customer->lname.', '.$customer->fname.' '.$customer->mname}}
                    </li>
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Status:</p>
                        {{$application->status}}
                    </li>
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Branch:</p>
                        {{$branch->key}}
                    </li>
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Sales Account:</p>
                        {{$application->salesAccount}}
                    </li>
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Dealer Sales Account:</p>
                        {{$application->dealerSalesAccount}}
                    </li>
                    <li class="w-1/2 mb-2">
                        <p class="font-bold">Dealer Unit:</p>
                        {{$application->desiredUnit}}
                    </li>
                    <li class="w-1/2">
                        <p class="font-bold">Dealer Unit:</p>
                        {{$application->desiredUnit}}
                    </li>
                </ul>
                <form action="">
                    <ul>
                        <li>
                            <label for="releasedUnit" class="font-bold">Released Unit</label>
                            <x-text-input id="releasedUnit" class="block mt-2" type="text" name="releasedUnit" value="{{old('releasedUnit', $application->releasedUnit)}}" />
                            <x-input-error :messages="$errors->get('releasedUnit')" class="mt-2" />
                        </li>
                        <li>
                            <label for="bracket" class="font-bold">Bracket</label>
                            <x-text-input id="bracket" class="block mt-2" type="text" name="bracket" value="{{old('bracket', $application->bracket)}}" />
                            <x-input-error :messages="$errors->get('bracket')" class="mt-2" />
                        </li>
                        <li>
                            <label for="notes" class="font-bold">Notes</label>
                            <textarea id="notes" rows="5" class="block mt-2 w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300" type="text" name="notes">{{old('notes', $application->notes)}}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </li>
                        <li>
                            <label for="recommendation" class="font-bold">Recommendation</label>
                            <textarea id="recommendation" rows="5" class="block mt-2 w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300" type="text" name="recommendation">{{old('recommendation', $application->recommendation)}}</textarea>
                            <x-input-error :messages="$errors->get('recommendation')" class="mt-2" />
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <div id="statusLog" class="search-overlay">
        <div class="search-wrap-bg"></div>
        <div class="search-wrap w-full md:w-96 mx-auto p-3 md:mt-5 bg-white">
            <input class="block w-full border border-gray-200 rounded p-2 pr-10 focus:outline-none focus:ring-1 focus:ring-violet-300" type="text" name="searchInput" value="" placeholder="Search customer name..." />
            <div class="circle-loader"></div>
            <div class="searchResults">
            </div>
        </div>
    </div>

@endsection
