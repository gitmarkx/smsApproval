<div class="md:w-1/2">
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Update Password</h3>
    <form method="POST" action="{{route('password.update', auth()->user()->id)}}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
        <!-- Current Password -->
        <div>
            <label for="current_password">Current Password</label>
            <x-text-input id="current_password" class="block mt-2" type="password" name="current_password" value="{{old('current_password')}}" autofocus/>
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <label for="password">Password</label>
            <x-text-input id="password" class="block mt-2" type="password" name="password" value="{{old('password')}}" autofocus/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <x-text-input id="password_confirmation" class="block mt-2" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" autofocus/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center">
            <x-primary-button class="mr-5 w-24">Save</x-primary-button>
            @if (session()->has('password-updated'))
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