<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\DemandeRequest;
use App\Models\Demande;
use App\Models\Etat;
use App\Models\Niveau;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if ($slug != $expectedSlug) {
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
        $demande = Demande::create($this->extract_data($demande, $request));
        return to_route('service.index')->with('success', 'La demande a bien été créée');
    }

    private function extract_data(Demande $demande, DemandeRequest $request)
    {
        $data = $request->validated($this->extract_data($demande, $request));
        /** @var Uploadedfile|null $image_demande */
        $image_demande = $request->validated('image_demande');
        if ($image_demande == null || $image_demande->getError()) {
            return $data;
        }
        if ($demande->image_demande) {
            Storage::disk('public')->delete($demande->image_demande);
        }
        $data['image_demande'] = $image_demande->store('file', 'public');
        /** @var Uploadedfile|null $cv */
        $cv = $request->validated('cv');
        if ($cv == null || $cv->getError()) {
            return $data;
        }
        if ($demande->cv) {
            Storage::disk('public')->delete($demande->cv);
        }
        $data['cv'] = $cv->store('file', 'public');
        /** @var Uploadedfile|null $lm */
        $lm = $request->validated('lm');
        if ($lm == null || $lm->getError()) {
            return $data;
        }
        if ($demande->lm) {
            Storage::disk('public')->delete($demande->lm);
        }
        $data['lm'] = $lm->store('file', 'public');
        /** @var Uploadedfile|null $autres */
        $autres = $request->validated('autres');
        if ($autres == null || $autres->getError()) {
            return $data;
        }
        if ($demande->autres) {
            Storage::disk('public')->delete($demande->autres);
        }
        $data['autres'] = $autres->store('file', 'public');
        return $data;
    }
}
