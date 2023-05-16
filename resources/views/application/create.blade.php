@extends('layouts.app')
@section('content')
    {{-- <x-breadcrumbs>User</x-breadcrumbs> --}}
    <form method="POST" action="{{ route('application.store') }}" enctype="multipart/form-data">
        @csrf
        <ul>
            <li class="md:w-96 mb-5">
                <div>
                    <p class="mb-2">Application Type</p>
                    <label for="newapp" class="relative pl-5 mr-5 cursor-pointer">
                        <input id="newapp" class="border absolute top-0.5 left-0 w-4 h-4" type="radio" name="applicationType" {{old('applicationType') ? '' : 'checked'}} value="0">New Application
                    </label>
                    <label for="reapp" class="relative pl-5 cursor-pointer">
                        <input id="reapp" class="border absolute top-0.5 left-0 w-4 h-4" type="radio" name="applicationType" {{old('applicationType') ? 'checked' : ''}} value="1">Reapplication
                    </label>
                    <x-input-error :messages="$errors->get('applicationType')" class="mt-2" />
                </label>
            </li>
            <li class="border p-5 rounded-sm mb-4">
                <x-text-input id="customer_id" class="block mt-2" type="text" name="customer_id" value="{{old('customer_id')}}" />
                <div class="md:flex flex-wrap">
                    <div class="mb-3 md:w-4/12">
                        <label for="fname">Firstname</label>
                        <x-text-input id="fname" class="block mt-2" type="text" name="fname" value="{{old('fname')}}" />
                        <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                    </div>
                    <div class="mb-3 md:w-4/12 md:px-3">
                        <label for="mname">Middlename</label>
                        <x-text-input id="mname" class="block mt-2" type="text" name="mname" value="{{old('mname')}}" />
                        <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                    </div>
                    <div class="md:w-4/12 mb-3 md:mb-0">
                        <label for="lname">Lastname</label>
                        <x-text-input id="lname" class="block mt-2" type="text" name="lname" value="{{old('lname')}}" />
                        <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                    </div>
                </div>
                <div class="md:flex flex-wrap">
                    <div class="mb-3 md:w-3/12">
                        <label for="contactNo">Contact No.</label>
                        <x-text-input id="contactNo" class="block mt-2" type="text" name="contactNo" value="{{old('contactNo')}}" />
                        <x-input-error :messages="$errors->get('contactNo')" class="mt-2" />
                    </div>
                    <div class="mb-3 md:w-9/12 md:pl-3">
                        <label for="address">Address</label>
                        <x-text-input id="address" class="block mt-2" type="text" name="address" value="{{old('address')}}" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>
            </li>
            <li class="border p-5 rounded-sm mb-4">
                <div class="md:flex flex-wrap">
                    <div class="mb-3 md:w-6/12 md:pr-2">
                        <label for="salesAccount">Sales Account</label>
                        <x-text-input id="salesAccount" class="block mt-2" type="text" name="salesAccount" value="{{old('salesAccount')}}" />
                        <x-input-error :messages="$errors->get('salesAccount')" class="mt-2" />
                    </div>
                    <div class="md:w-6/12 mb-3 md:mb-0 md:pl-2">
                        <label for="dealerSalesAccount">Dealer Sales Account</label>
                        <x-text-input id="dealerSalesAccount" class="block mt-2" type="text" name="dealerSalesAccount" value="{{old('dealerSalesAccount')}}" />
                        <x-input-error :messages="$errors->get('dealerSalesAccount')" class="mt-2" />
                    </div>
                </div>
                <div class="md:flex flex-wrap">
                    <div class="mb-3 md:w-6/12 md:pr-2">
                        <label for="desiredUnit">Desire Unit</label>
                        <x-text-input id="desiredUnit" class="block mt-2" type="text" name="desiredUnit" value="{{old('desiredUnit')}}" />
                        <x-input-error :messages="$errors->get('desiredUnit')" class="mt-2" />
                    </div>
                    <div class="md:w-6/12 mb-3 md:mb-0 md:pl-2">
                        <label for="bip">BIP</label>
                        <x-text-input id="bip" class="block mt-2" type="text" name="bip" value="{{old('bip')}}" />
                        <x-input-error :messages="$errors->get('bip')" class="mt-2" />
                    </div>
                </div>
                <div class="md:flex flex-wrap">
                    <div class="mb-3 md:w-6/12 md:pr-2">
                        <label for="imgSrc">Documents</label>
                        <x-text-input id="imgSrc" class="block mt-2" type="file" name="imgSrc[]" multiple value="{{ is_array(old('imgSrc')) ? implode(',', old('imgSrc')) : old('imgSrc') }}" />
                        <x-input-error :messages="$errors->get('imgSrc')" class="mt-2" />
                    </div>
                    
                    <div class="md:w-6/12 mb-3 md:mb-0 md:pl-2">
                    </div>
                </div>
            </li>
            <li class="text-right">
                <x-primary-button class="w-full md:w-3/12">Save</x-primary-button>
            </li>
        </ul>
    </form>
@endsection
