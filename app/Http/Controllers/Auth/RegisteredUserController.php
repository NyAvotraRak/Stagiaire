<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Fonction;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // public function create(): View
    // {
    //     return view('auth.register');
    // }
    public function create(): View
    {
        $fonctions = Fonction::all();
        $services = Service::all();

        return view('auth.register', compact('fonctions', 'services'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = new User();

        // Hasher le mot de passe avant de l'assigner à l'utilisateur
        $hashedPassword = Hash::make($request->input('password'));

        $user = User::create($this->extract_data($user, $request));

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }

    // private function extract_data(User $user, ProfileUpdateRequest $request)
    // {
    //     $data = $request->validated();
    //     /** @var Uploadedfile|null $image_users */
    //     $image_users = $request->validated('image_users');
    //     if ($image_users == null || $image_users->getError()) {
    //         return $data;
    //     }
    //     if ($user && $user->image_users) {
    //         Storage::disk('public')->delete($user->image_users);
    //     }
    //     $data['image_users'] = $image_users->store('file', 'public');
    //     return $data;
    // }
    // private function extract_data(User $user, ProfileUpdateRequest $request)
    // {
    //     $data = $request->validated();

    //     // Utilisez la méthode file() pour accéder à l'objet UploadedFile
    //     $image_users = $request->file('image_users');

    //     // Vérifiez si $image_users n'est pas null avant d'accéder à ses propriétés
    //     if ($image_users !== null && !$image_users->getError()) {
    //         // Vérifiez également si $user n'est pas null avant d'accéder à sa propriété image_users
    //         if ($user !== null && $user->image_users) {
    //             Storage::disk('public')->delete($user->image_users);
    //         }
    //         $data['image_users'] = $image_users->store('file', 'public');
    //     }

    //     return $data;
    // }
    private function extract_data(User $user, ProfileUpdateRequest $request)
{
    $data = $request->validated();

    // Vérifie si une image a été téléchargée
    if ($request->hasFile('image_users')) {
        // Obtient l'objet UploadedFile de l'image
        $image_users = $request->file('image_users');

        // Vérifie si l'objet UploadedFile n'est pas nul et s'il n'y a pas d'erreur lors du téléchargement
        if ($image_users !== null && !$image_users->getError()) {
            // Si l'utilisateur a déjà une image enregistrée, supprimez-la
            if ($user->image_users) {
                Storage::disk('public')->delete($user->image_users);
            }

            // Stocke la nouvelle image et met à jour les données avec le chemin d'accès
            $data['image_users'] = $image_users->store('file', 'public');
        }
    }

    return $data;
}

}
