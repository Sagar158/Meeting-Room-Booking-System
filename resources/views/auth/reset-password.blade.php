<x-guest-layout>
    <div class="auth-form-wrapper px-4 py-5">
        <div class="text-center">
            <img src="{{ asset('/assets/images/laravel-2.svg') }}" class="guest-logo">
        </div>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"  placeholder="{{ __('Email') }}"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
