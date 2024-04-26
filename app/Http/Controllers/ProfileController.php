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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        return Redirect::to('/');
    }
}
