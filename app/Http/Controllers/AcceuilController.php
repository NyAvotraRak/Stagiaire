<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\DemandeRequest;
use App\Models\Demande;
use App\Models\Etat;
use App\Models\Ministere;
use App\Models\Niveau;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcceuilController extends Controller
{
    public function index()
    {
        $ministeres = Ministere::orderBy('created_at', 'desc')->get();
        $services = Service::orderBy('created_at', 'desc')->get();
        // dd($ministere);
        return view('acceuil', ['services' => $services, 'ministeres' => $ministeres]);
    }

    public function show(string $slug, Service $service)
    {
        $demande = new Demande();
        $expectedSlug = $service->getSlug();
        if ($slug != $expectedSlug) {
            return to_route('acceuil.show', [
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

    // public function postule(DemandeRequest $request)
    // {
    //     $demande = new Demande();
    //     // Créer une nouvelle demande en utilisant les données validées du formulaire
    //     $demande = Demande::create($this->extract_data($demande, $request));

    //     // Rediriger l'utilisateur vers la page d'accueil après avoir créé la demande
    //     return redirect()->route('acceuil.index')->with('success', 'La demande a bien été créée');
    // }

    // private function extract_data(Demande $demande, DemandeRequest $request)
    // {
    //     $data = $request->validated($this->extract_data($demande, $request));
    //     /** @var Uploadedfile|null $image_demande */
    //     $image_demande = $request->validated('image_demande');
    //     if ($image_demande == null || $image_demande->getError()) {
    //         return $data;
    //     }
    //     if ($demande->image_demande) {
    //         Storage::disk('public')->delete($demande->image_demande);
    //     }
    //     $data['image_demande'] = $image_demande->store('file', 'public');
    //     /** @var Uploadedfile|null $cv */
    //     $cv = $request->validated('cv');
    //     if ($cv == null || $cv->getError()) {
    //         return $data;
    //     }
    //     if ($demande->cv) {
    //         Storage::disk('public')->delete($demande->cv);
    //     }
    //     $data['cv'] = $cv->store('file', 'public');
    //     /** @var Uploadedfile|null $lm */
    //     $lm = $request->validated('lm');
    //     if ($lm == null || $lm->getError()) {
    //         return $data;
    //     }
    //     if ($demande->lm) {
    //         Storage::disk('public')->delete($demande->lm);
    //     }
    //     $data['lm'] = $lm->store('file', 'public');
    //     /** @var Uploadedfile|null $autres */
    //     $autres = $request->validated('autres');
    //     if ($autres == null || $autres->getError()) {
    //         return $data;
    //     }
    //     if ($demande->autres) {
    //         Storage::disk('public')->delete($demande->autres);
    //     }
    //     $data['autres'] = $autres->store('file', 'public');
    //     return $data;
    // }
    //     private function extract_data(Demande $demande, DemandeRequest $request)
    // {
    //     $data = $request->validated();

    //     // Traitement de image_demande
    //     if ($request->hasFile('image_demande')) {
    //         $this->traiterFichier($demande->image_demande, $request->file('image_demande'), 'image_demande');
    //     }

    //     // Traitement de cv
    //     if ($request->hasFile('cv')) {
    //         $this->traiterFichier($demande->cv, $request->file('cv'), 'cv');
    //     }

    //     // Traitement de lm
    //     if ($request->hasFile('lm')) {
    //         $this->traiterFichier($demande->lm, $request->file('lm'), 'lm');
    //     }

    //     // Traitement de autres
    //     if ($request->hasFile('autres')) {
    //         $this->traiterFichier($demande->autres, $request->file('autres'), 'autres');
    //     }

    //     return $data;
    // }

    // private function traiterFichier($fichierExistant, $fichierTelecharge, $attribut)
    // {
    //     if ($fichierExistant) {
    //         Storage::disk('public')->delete($fichierExistant);
    //     }
    //     return $fichierTelecharge->store('file', 'public');
    // }
    public function postule(DemandeRequest $request)
    {
        // dd('re');
        // Créer une nouvelle demande en utilisant les données validées du formulaire
        $demande = Demande::create($this->extract_data($request));
        // $pdfMimeType = $request->file('cv')->getClientMimeType();

        // Rediriger l'utilisateur vers la page d'accueil après avoir créé la demande
        return redirect()->route('acceuil.index')->with('success', 'La demande a bien été envoyée, Veuillez visiter souvent votre email pour le retour');
    }

    private function extract_data(DemandeRequest $request)
    {
        $data = $request->validated();

        // Traitement de image_demande
        if ($request->hasFile('image_demande')) {
            $data['image_demande'] = $request->file('image_demande')->store('file', 'public');
        }

        // Traitement de cv
        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('file', 'public');
        }

        // Traitement de lm
        if ($request->hasFile('lm')) {
            $data['lm'] = $request->file('lm')->store('file', 'public');
        }

        // Traitement de autres
        if ($request->hasFile('autres')) {
            $data['autres'] = $request->file('autres')->store('file', 'public');
        }

        return $data;
    }
}
