
<form action="{{route('application.update', $application->id)}}" method="POST" id="b-form-app">
    @csrf
    @method('PUT')
    <ul>
        <li class="mb-3">
            <label for="releasedUnit" class="font-bold">Released Unit</label>
            <x-text-input id="releasedUnit" class="block mt-2" type="text" name="releasedUnit" value="{{old('releasedUnit', $application->releasedUnit)}}" />
            <x-input-error :messages="$errors->get('releasedUnit')" class="mt-2" />
        </li>
        <li class="mb-3">
            <p class="font-bold">Bracket</p>
            <p>{{$application->bracket}}</p>
        </li>
        <li class="mb-3">
            <p class="font-bold">Notes</p>
            <p>{{$application->notes}}</p>
        </li>
        <li>
            <p class="font-bold">Recommendation</p>
            <p>{{$application->recommendation}}</p>
        </li>
    </ul>
    <hr class="my-5">
    @if (auth()->user()->authorizationType === 'B')
        <ul class="flex flex-wrap ">
            @unless ($application->status === 'Cancel' || $application->status === 'Approve' || $application->status === 'Disapprove' || $application->status === 'Release')
                <li class="w-1/2 px-1 mb-3">
                    <x-primary-button class="mr-5 w-24" name="Cancel">Cancel</x-primary-button>
                </li>
            @endunless
            @if ($application->status === 'Approve')
                <li class="w-1/2 px-1 mb-3">
                    <x-primary-button class="mr-5 w-24" name="Release">Release</x-primary-button>
                </li>
            @endif
            @unless ($application->status === 'Release')
                <li class="w-1/2 px-1 mb-3">
                    <x-primary-button class="mr-5 w-24" name="Delete">Delete</x-primary-button>
                </li>
            @endunless
        </ul>
    @endif
    <input type="hidden" name="clickEvent" id="clickEvent">
</form>