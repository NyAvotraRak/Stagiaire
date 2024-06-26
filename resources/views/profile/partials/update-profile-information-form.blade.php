<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettre à jour les informations de profil de votre compte et l'adresse e-mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update', $user) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="image_users" :value="__('Image de profil')" />
            <input id="image_users" name="image_users" type="file" class="mt-1 block w-full" accept="image/*"
                value="{{ old('image_users', $user->image_url()) }}" />
            <x-input-error :messages="$errors->updateProfile->get('image_users')" class="mt-2" />
        </div>


        <div>
            <x-input-label for="nom_user" :value="__('Nom')" />
            <x-text-input id="nom_user" name="nom_user" type="text" class="mt-1 block w-full" :value="old('nom_user', $user->nom_user)"
                required autofocus autocomplete="nom_user" />
            <x-input-error class="mt-2" :messages="$errors->get('nom_user')" />
        </div>
        <div>
            <x-input-label for="prenom_user" :value="__('Prenom')" />
            <x-text-input id="prenom_user" name="prenom_user" type="text" class="mt-1 block w-full" :value="old('prenom_user', $user->prenom_user)"
                required autofocus autocomplete="prenom_user" />
            <x-input-error class="mt-2" :messages="$errors->get('prenom_user')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Function -->
        <div>
            <x-input-label for="fonction_id" :value="__('Fonction')" />
            <select id="fonction_id" name="fonction_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($fonctions as $fonction)
                    @php
                        $optionValue = $fonction->id . '_' . $fonction->service_id;
                        $oldValue = old('fonction_id', $user->fonction_id . '_' . $user->fonction->service_id);
                        // dd($optionValue, $oldValue);
                    @endphp
                    <option value="{{ $optionValue }}" {{ $oldValue == $optionValue ? 'selected' : '' }}>
                        <strong>Fonction : </strong>{{ $fonction->nom_fonction }} - <strong>Service :
                        </strong>{{ $fonction->service->nom_service }}
                    </option>
                @endforeach
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('fonction_id')" />
        </div>

        <!-- Verification Email -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <!-- Unverified Email -->
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                    <button form="send-verification"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                    </p>
                @endif
            </div>
        @endif
        <br>
        <br>
        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Votre profil a été bien modifié') }}</p>
            @endif
        </div>
    </form>
</section>
