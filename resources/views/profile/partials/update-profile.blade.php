<div class="md:w-1/2">
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Informations</h3>
    <form method="POST" action="{{route('profile.update', auth()->user()->id)}}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <x-text-input id="name" class="block mt-2" type="text" name="name" value="{{old('name', auth()->user()->name)}}" autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <x-text-input id="email" class="block mt-2" type="text" name="email" value="{{old('email', auth()->user()->email)}}" autofocus disabled/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center">
            <x-primary-button class="mr-5 w-24">Save</x-primary-button>
            @if (session()->has('profile-updated'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</div>