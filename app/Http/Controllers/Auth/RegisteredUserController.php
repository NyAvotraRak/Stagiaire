<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
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
use App\Models\FonctionService;
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
        $fonctions = Fonction::with('service')->get();

        return view('auth.register', compact('fonctions'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        // dd($request);
        // Crée une nouvelle instance d'utilisateur
        $user = new User();

        // Extraction des données du formulaire et création de l'utilisateur avec mot de passe hashé
        $userData = $this->extract_data($user, $request);
        $userData['password'] = bcrypt($request->input('password')); // Hashage du mot de passe


        // Récupérer la valeur de fonction_service sélectionnée
        $selectedFonctionService = $request->input('fonction_id');

        // Séparer service_id et fonction_id
        list($fonctionId, $serviceId) = explode('_', $selectedFonctionService);

        // Ajouter les IDs de service et de fonction aux données de l'utilisateur
        $userData['fonction_id'] = $fonctionId;


        // Créer l'utilisateur avec les données fournies
        $user = User::create($userData);

        // Émettre un événement pour indiquer l'enregistrement de l'utilisateur
        event(new Registered($user));

        // Redirection vers la page de connexion avec un message de succès
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
    private function extract_data(User $user, RegisterRequest $request)
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
