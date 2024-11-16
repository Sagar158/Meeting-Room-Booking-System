<x-guest-layout>

    <div class="auth-form-wrapper px-4 py-5">
        <div class="text-center">
            <img src="{{ asset('/assets/images/laravel-2.svg') }}" class="guest-logo">
        </div>
        <h5 class="text-muted font-weight-normal mb-4 text-center">Welcome back! Log in to your account.</h5>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
            <x-text-input id="password" type="password" name="password" :value="old('password')" required autofocus autocomplete="username" placeholder="Password" required autocomplete="current-password" />

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </form>
    </div>

</x-guest-layout>
