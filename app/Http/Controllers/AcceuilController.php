<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\DemandeRequest;
use App\Models\Demande;
use App\Models\Etat;
use App\Models\Niveau;
use App\Models\Service;
use Illuminate\Http\Request;

class AcceuilController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('acceuil', ['services' => $services]);
    }

    public function show(string $slug, Service $service)
    {
        $demande = new Demande();
        $expectedSlug = $service->getSlug();
        if($slug != $expectedSlug){
            return to_route('service.show', [
                'slug' => $expectedSlug,
                'service' => $service
            ]);
        }
        return view('service.show', [
            'service' => $service,
            'demande' => $demande,
            'niveaux' => Niveau::pluck('nom_niveau', 'id'),
            'etats' => Etat::pluck('nom_etat', 'id'),
            'services' => Service::pluck('nom_service', 'id')
        ]);
    }

    public function postule(DemandeRequest $request)
    {
        // Créer une nouvelle demande en utilisant les données validées du formulaire
        $demande = Demande::create($request->validated());

        // Rediriger l'utilisateur vers la page d'accueil après avoir créé la demande
        return redirect()->route('acceuil.index')->with('success', 'La demande a bien été créée');
    }

}
