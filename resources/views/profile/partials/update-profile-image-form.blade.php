<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile image.") }}
        </p>
    </header>

    <form method="post" action="{{ route('photo-profile-edit', $user->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <div class="flex gap-4">
                <div class="flex w-24 h-24 rounded-full">
                    <img src="{{ asset('storage/' . $user->images) }}" alt="profile image" class="rounded-full">
                </div>
                <div id="preview-profile" class="flex items-center rounded-full"></div>
            </div>
            <div class="mt-4">
                <input 
                    id="image_profile"
                    type="file"
                    name="image_profile"
                    accept="image/*"
                    class="block w-full text-lg text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-xl file:border-0
                        file:text-lg file:font-medium
                        file:bg-rose-50 file:text-rose-600
                        hover:file:bg-rose-100"
                >
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
