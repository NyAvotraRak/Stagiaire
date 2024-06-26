<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Image -->
        <div>
            <x-input-label for="image_users" :value="__('Photo')" />
            <x-text-input id="image_users" class="block mt-1 w-full" type="file" name="image_users" :value="old('image_users')"
                required autofocus autocomplete="image_users" />
            <x-input-error :messages="$errors->get('image_users')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="nom_user" :value="__('Nom')" />
            <x-text-input id="nom_user" class="block mt-1 w-full" type="text" name="nom_user" :value="old('nom_user')"
                required autofocus autocomplete="nom_user" />
            <x-input-error :messages="$errors->get('nom_user')" class="mt-2" />
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="prenom_user" :value="__('Prenom')" />
            <x-text-input id="prenom_user" class="block mt-1 w-full" type="text" name="prenom_user" :value="old('prenom_user')"
                required autofocus autocomplete="prenom_user" />
            <x-input-error :messages="$errors->get('prenom_user')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- FonctionService Select -->
        <div class="mt-4">
            <x-input-label for="fonction_id" :value="__('Service et Fonction')" />
            <select id="fonction_id" name="fonction_id" class="block mt-1 w-full" required>
                <option value="">{{ __('Choisissez un service et une fonction') }}</option>
                @foreach ($fonctions as $fonction)
                    <option value="{{ $fonction->id }}_{{ $fonction->service_id }}">
                        <strong>Fonction : </strong>{{ $fonction->nom_fonction }} - <strong>Service :
                        </strong>{{ $fonction->service->nom_service }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('fonction_id')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Avez-vous déjà un compte?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
