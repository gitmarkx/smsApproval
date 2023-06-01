
<form action="">
    <ul>
        <li class="mb-3">
            <label for="releasedUnit" class="font-bold">Released Unit</label>
            <x-text-input id="releasedUnit" class="block mt-2" type="text" name="releasedUnit" value="{{old('releasedUnit', $application->releasedUnit)}}" />
            <x-input-error :messages="$errors->get('releasedUnit')" class="mt-2" />
        </li>
        <li class="mb-3">
            <label for="bracket" class="font-bold">Bracket</label>
            <p>{{$application->bracket}}</p>
        </li>
        <li class="mb-3">
            <label for="notes" class="font-bold">Notes</label>
            <p>{{$application->notes}}</p>
        </li>
        <li>
            <label for="recommendation" class="font-bold">Recommendation</label>
            <p>{{$application->recommendation}}</p>
        </li>
    </ul>
    <hr class="my-5">
    @if (auth()->user()->authorizationType === 'B')
        <ul class="flex flex-wrap ">
            @unless ($application->status === 'Canceled')
                <li class="w-1/2 px-1">
                    <x-primary-button class="mr-5 w-24">Cancel</x-primary-button>
                </li>
            @endunless
            @if ($application->status === 'Canceled' || $application->status === 'Disapproved')
                <li class="w-1/2 px-1">
                    <x-primary-button class="mr-5 w-24">Reprocessed</x-primary-button>
                </li>
            @endif
            <li class="w-1/2 px-1">
                <x-primary-button class="mr-5 w-24">Delete</x-primary-button>
            </li>
        </ul>
    @endif
</form>