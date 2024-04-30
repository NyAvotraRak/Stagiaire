<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Image -->
        <div>
            <x-input-label for="image_users" :value="__('Photo')" />
            <x-text-input id="image_users" class="block mt-1 w-full" type="file" name="image_users" :value="old('image_users')" required autofocus autocomplete="image_users" />
            <x-input-error :messages="$errors->get('image_users')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Fonction -->
        <div class="mt-4">
            <x-input-label for="fonction" :value="__('Fonction')" />
            <select id="fonction" name="fonction_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($fonctions as $fonction)
                    <option value="{{ $fonction->id }}">{{ $fonction->nom_fonction }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('fonction_id')" class="mt-2" />
        </div>

        <!-- Service -->
        <div class="mt-4">
            <x-input-label for="service" :value="__('Service')" />
            <select id="service" name="service_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Avez-vous déjà un compte?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
