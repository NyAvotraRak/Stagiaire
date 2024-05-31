<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\SearchUserRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Fonction;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // public function index(SearchUserRequest $request)
    // {
    //     $nom_user = $request->input('nom_user');
    //     $prenom_user = $request->input('prenom_user');
    //     $nom_fonction = $request->input('nom_fonction');
    //     $role = $request->input('role');
    //     // dd($role);
    //     // Récupérer tous les utilisateurs avec leurs relations
    //     $query = User::with('fonction', 'fonction.service')->orderBy('created_at', 'desc');
    //     // Vérifiez si le nom_demande est présent dans les données validées
    //     if ($nom_user = $request->validated()['nom_user'] ?? null) {
    //         $query->where('nom_user', 'like', "%{$nom_user}%");
    //     }

    //     // Vérifiez si le prenom_demande est présent dans les données validées
    //     if ($prenom_user = $request->validated()['prenom_user'] ?? null) {
    //         $query->where('prenom_user', 'like', "%{$prenom_user}%");
    //     }
    //     // Vérifiez si le nom_demande est présent dans les données validées
    //     if ($nom_fonction = $request->validated()['nom_fonction'] ?? null) {
    //         $query->where('fonctions.nom_fonction', 'like', "%{$nom_fonction}%");
    //     }

    //     // Vérifiez si le prenom_demande est présent dans les données validées
    //     if ($role = $request->validated()['role'] ?? null) {
    //         $query->where('fonctions.role', 'like', "%{$role}%");
    //     }
    //     $users = $query->get();

    //     // Retourner la vue avec les utilisateurs
    //     return view('admin.users.index', compact('users'));
    // }
    public function index(SearchUserRequest $request)
    {
        $nom_user = $request->input('nom_user');
        $prenom_user = $request->input('prenom_user');
        $nom_fonction = $request->input('nom_fonction');
        $role = $request->input('role');

        // Récupérer tous les utilisateurs avec leurs relations
        $query = User::with('fonction', 'fonction.service')->orderBy('created_at', 'desc');

        // Vérifiez si le nom_user est présent dans les données validées
        if ($nom_user = $request->validated()['nom_user'] ?? null) {
            $query->where('nom_user', 'like', "%{$nom_user}%");
        }

        // Vérifiez si le prenom_user est présent dans les données validées
        if ($prenom_user = $request->validated()['prenom_user'] ?? null) {
            $query->where('prenom_user', 'like', "%{$prenom_user}%");
        }

        // Vérifiez si le nom_fonction est présent dans les données validées
        if ($nom_fonction = $request->validated()['nom_fonction'] ?? null) {
            $query->whereHas('fonction', function ($q) use ($nom_fonction) {
                $q->where('nom_fonction', 'like', "%{$nom_fonction}%");
            });
        }

        // Vérifiez si le role est présent dans les données validées
        if ($role = $request->validated()['role'] ?? null) {
            $query->whereHas('fonction', function ($q) use ($role) {
                $q->where('role', 'like', "%{$role}%");
            });
        }

        // Obtenir les utilisateurs
        $users = $query->get();  // Utilisation correcte de la méthode get()

        // Compter le nombre total d'utilisateurs par fonction
        $usersByFonction = $query->selectRaw('fonction_id, COUNT(*) as total')
            ->groupBy('fonction_id')
            ->with('fonction')
            ->get();

        // Préparer les données pour la vue
        $totalUsers = $users->count();
        $totalUsersByFonction = $usersByFonction->mapWithKeys(function ($item) use ($totalUsers) {
            $pourcentage = $totalUsers > 0 ? ($item->total / $totalUsers) * 100 : 0;
            return [
                $item->fonction->nom_fonction => [
                    'total' => $item->total,
                    'pourcentage' => $pourcentage,
                ]
            ];
        });

        // Retourner la vue avec les utilisateurs et les totaux par fonction
        return view('admin.users.index', compact('users', 'totalUsers', 'totalUsersByFonction'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $request->user();
        // dd($user);

        $fonctions = Fonction::with('service')->get();

        // // Récupérer toutes les fonctions et tous les services
        // $fonctions = Fonction::all();
        // $services = Service::all();

        // Passer les données à la vue
        return view('profile.edit', [
            'user' => $user,
            'fonctions' => $fonctions,
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

        // Récupérer la valeur de fonction_service sélectionnée
        $selectedFonctionService = $request->input('fonction_id');

        // Séparer service_id et fonction_id
        list($fonctionId, $serviceId) = explode('_', $selectedFonctionService);

        // Ajouter les IDs de service et de fonction aux données de l'utilisateur
        $data['fonction_id'] = $fonctionId;

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
