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
    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        $request->validate([
            'image_users' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fonction_id' => ['required', 'exists:fonctions,id'], // Valider que fonction_id existe dans la table fonctions
            'service_id' => ['required', 'exists:services,id'], // Valider que service_id existe dans la table services
        ]);

        $user = User::create($this->extract_data($user, $request));

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
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
}
