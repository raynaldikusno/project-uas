<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <div class="mt-1 block w-full">
                <label>
                    <input type="radio" name="profile_image" value="profile1.jpg" {{ $user->profile == 'profile1.jpg' ? 'checked' : '' }} required>
                    <img src="/images/profile1.jpg" alt="Profile 1" width="100">
                </label>
                <label>
                    <input type="radio" name="profile_image" value="profile2.jpg" {{ $user->profile == 'profile2.jpg' ? 'checked' : '' }} required>
                    <img src="/images/profile2.jpg" alt="Profile 2" width="100">
                </label>
                <label>
                    <input type="radio" name="profile_image" value="profile3.jpg" {{ $user->profile == 'profile3.jpg' ? 'checked' : '' }} required>
                    <img src="/images/profile3.jpg" alt="Profile 3" width="100">
                </label>
                <label>
                    <input type="radio" name="profile_image" value="profile4.jpg" {{ $user->profile == 'profile4.jpg' ? 'checked' : '' }} required>
                    <img src="/images/profile4.jpg" alt="Profile 4" width="100">
                </label>
                <label>
                    <input type="radio" name="profile_image" value="profile5.jpg" {{ $user->profile == 'profile5.jpg' ? 'checked' : '' }} required>
                    <img src="/images/profile5.jpg" alt="Profile 5" width="100">
                </label>
                <label>
                    <input type="radio" name="profile_image" value="profile6.jpg" {{ $user->profile == 'profile6.jpg' ? 'checked' : '' }} required>
                    <img src="/images/profile6.jpg" alt="Profile 6" width="100">
                </label>
                <!-- Add more profile image options if needed -->
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

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

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </form>
</section>
