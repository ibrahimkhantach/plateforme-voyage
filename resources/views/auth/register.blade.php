<x-guest-layout>
<h1 class="text-white text-center text-[30px]">Create Compte</h1>
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <x-input-label for="image" :value="__('Image')" />
        <x-text-input id="image" class="block mt-1 w-full"
            type="file" name="image" :value="old('image')" required autofocus
            autocomplete="image" />
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="name" :value="__('Full Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
            required autocomplete="name" />
        
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>


    <div class="mt-4">
        <x-input-label for="description" :value="__('description')" />

        <textarea id="description" name="description" required autocomplete="description"
            class="block mt-1 w-full h-[100px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>

        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autocomplete="username" />
        
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div> <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
            name="password_confirmation" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>
</x-guest-layout>