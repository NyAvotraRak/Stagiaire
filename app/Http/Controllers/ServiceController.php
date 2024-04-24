<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\DemandeRequest;
use App\Models\Demande;
use App\Models\Etat;
use App\Models\Niveau;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('home', ['services' => $services]);
    }
    public function show(string $slug, Service $service)
    {
        $demande = new Demande();
        $expectedSlug = $service->getSlug();
        if($slug != $expectedSlug){
            return to_route('service.show', ['slug' => $expectedSlug, 'service' => $service]);
        }

        return view('service.show', [
            'service' => $service,
            'demande' => $demande,
            'services' => Service::pluck('nom_service', 'id'),
            'niveaux' => Niveau::pluck('nom_niveau', 'id'),
            'etats' => Etat::pluck('nom_etat', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandeRequest $request, Demande $demande)
    {
        $demande = Demande::create($request->validated());
        return to_route('service.index')->with('success', 'La demande a bien été créée');
    }
}
