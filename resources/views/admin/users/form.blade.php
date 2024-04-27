<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informations du profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Mettre à jour les informations de profil de votre compte et l'adresse e-mail.
        </p>
    </header>

    <form method="post" action="" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="image_users" class="block text-sm font-medium text-gray-700">Image</label>
            <input id="image_users" name="image_users" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('image_users', $user->image_users) }}" required autofocus autocomplete="image_users">
            @error('image_users')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="image_users" class="block text-sm font-medium text-gray-700">Image</label>
            <input id="image_users" name="image_users" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('image_users', $user->image_users) }}" required autofocus autocomplete="image_users">
            @error('image_users')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="image_users" class="block text-sm font-medium text-gray-700">Image</label>
            <input id="image_users" name="image_users" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('image_users', $user->image_users) }}" required autofocus autocomplete="image_users">
            @error('image_users')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rest of the form fields -->

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Enregistrer</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">Votre profil a été bien modifié</p>
            @endif
        </div>
    </form>
</section>
