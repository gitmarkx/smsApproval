@extends('layouts.app')
@section('content')
    {{-- {{$application}} --}}
    @if (session('documents.uploaded'))
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="mb-3 text-sm text-gray-600 dark:text-gray-400"
        >{{ __(session('documents.uploaded')) }}</p>
    @endif
    <div class="w-full relative">
        <div class="flex flex-wrap">
            <div class="imgWrap pr-5 w-full mb-5 lg:w-1/2 lg:mb-5" x-data="{ open: false }">
                <div class="w-full">
                    <a class="mr-3 cursor-pointer" id="btnStatusLog">Status Logs</a>
                    <a x-on:click="open = !open" class="cursor-pointer">Upload Documents</a>
                </div>
                <div class="">
                    <form action="{{route('application.uploadDocs')}}" method="POST" enctype="multipart/form-data" :class="open ? 'border p-3 mt-3' : 'hidden'" >
                        @csrf
                        <input type="hidden" value="{{$application->id}}" name="app_id">
                        <input type="hidden" value="{{$customer->id}}" name="customer_id">
                        <input type="hidden" value="{{$customer->lname . ','. $customer->fname}}" name="name">
                        <div>
                            <label for="imgSrc">Documents</label>
                            <x-text-input id="imgSrc" class="block mt-2" type="file" name="imgSrc[]" multiple accept="image/*" required value="{{ is_array(old('imgSrc')) ? implode(',', old('imgSrc')) : old('imgSrc') }}" />
                            <x-input-error :messages="$errors->get('imgSrc')" class="mt-2" />
                        </div>
                        <div class="text-right mt-2">
                            <x-primary-button class="w-full md:w-3/12 py-1 px-1">Upload</x-primary-button>
                        </div>
                    </form>
                    <ul class="flex flex-wrap border p-3 mt-3"> 
                        @foreach ($images as $image)
                            <li class="w-14 mr-3">
                                <img class="aspect-square object-cover" src="{{ asset('storage/'.$image->imgSrc.'') }}" alt="Image">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="appInfo w-full lg:w-1/2">
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
                <hr class="my-3">
                @if (auth()->user()->authorizationType === 'B')
                    @include('layouts.appForm.appForm-b')
                @endif
            </div>
        </div>
    </div>
    <div id="statusLog" class="modal-overlay">
        <div class="modal-overlay-bg"></div>
        <div class="modal-wrap status-wrap w-full md:w-96 mx-auto p-3 md:mt-5 bg-white">
            <div class="statusLog">
                <p class="mb-5">Status Log</p>
                <ul>
                    @foreach ($logs as $log)
                    <li class="b border-b py-2">
                        <b>{{$log->status}}</b> on {{ date('F j, Y', strtotime($log->created_at)) }} by {{$log->users->name}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
