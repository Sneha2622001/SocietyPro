<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Contact Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your contact information is accurate to receive important notifications.') }}
        </p>
    </header>

    <form method="post" action="{{ route('contact.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        
        <div>
            <x-input-label for="update_contact_phone" :value="__('Phone Number')" />
            <x-text-input id="update_contact_phone" name="phone" type="text" class="mt-1 block w-full" autocomplete="tel" />
            <x-input-error :messages="$errors->updateContact->get('phone')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'contact-updated')
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
</section>
