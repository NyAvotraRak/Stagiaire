<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Fonction;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs avec leurs relations
        $users = User::with('service', 'fonction')->get();

        // Retourner la vue avec les utilisateurs
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $request->user();

        // Récupérer toutes les fonctions et tous les services
        $fonctions = Fonction::all();
        $services = Service::all();

        // Passer les données à la vue
        return view('profile.edit', [
            'user' => $user,
            'fonctions' => $fonctions,
            'services' => $services,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(User $user, ProfileUpdateRequest $request): RedirectResponse
    // {
    //     // dd($user);
    //     // dd($request);
    //     $request->user()->fill($this->extract_data($user, $request));

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request);
        $data = $request->validated();
        $imagePath = $request->user()->image_users; // Par défaut, conservez l'ancienne image

        // Vérifie si une image a été téléchargée
        if ($request->hasFile('image_users')) {
            $image = $request->file('image_users');

            // Manipulez le fichier de l'image selon vos besoins
            $imagePath = $image->store('file', 'public');

            // Supprimez l'ancienne image s'il existe
            if ($request->user()->image_users) {
                Storage::disk('public')->delete($request->user()->image_users);
            }
        }

        // Met à jour les données de l'utilisateur avec le nouveau chemin d'image
        $data['image_users'] = $imagePath;

        // Met à jour les données de l'utilisateur
        $request->user()->update($data);

        // Redirigez l'utilisateur vers la page de modification du profil
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }




    private function extract_data(User $user, ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        /** @var Uploadedfile|null $image_users */
        $image_users = $request->validated('image_users');
        if ($image_users == null || $image_users->getError()) {
            return $data;
        }
        if ($user->image_users) {
            Storage::disk('public')->delete($user->image_users);
        }
        $data['image_users'] = $image_users->store('file', 'public');
        return $data;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
