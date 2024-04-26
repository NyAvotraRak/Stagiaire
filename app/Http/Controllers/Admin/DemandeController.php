<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DemandeRequest;
use App\Http\Requests\Admin\SearchDemandeRequest;
use App\Mail\DemandeContactMail;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchDemandeRequest $request)
    {
        // Commencez par une requête Eloquent vide
        $query = Demande::query();

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_demande = $request->validated('nom_demande')) {
            $query->where('nom_demande', 'like', "%{$nom_demande}%");
        }

        // Vérifiez si le prenom_demande est présent dans les données validées
        if ($prenom_demande = $request->validated('prenom_demande')) {
            $query->where('prenom_demande', 'like', "%{$prenom_demande}%");
        }

        // Ajoutez une jointure avec la table `etats`
        $query->join('etats', 'demandes.etat_id', '=', 'etats.id');

        // Ajoutez les conditions pour filtrer par l'état "En attente" ou "Entretien"
        $query->where(function ($query) {
            $query->where('etats.nom_etat', 'En attente')
                ->orWhere('etats.nom_etat', 'Entretien');
        });

        // Triez les résultats par ID d'état de manière décroissante
        $query->orderBy('etats.id', 'desc');

        // Exécutez la requête et récupérez les résultats
        $demandes = $query->get();

        return view('admin.demandes.index', compact('demandes'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandeRequest $request, Demande $demande)
    {
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Demande $demande)
    {
        $demande->update([
            'etat_id' => 2, // Mettre à jour l'état directement
        ]);

        // Vérifier si l'état est égal à 2 avant d'envoyer l'e-mail
        if ($demande->etat_id == 2) {
            // Envoyer un e-mail après la mise à jour de la demande
            Mail::to($demande->email_demande)
                ->send(new DemandeContactMail($demande));
        }

        // Rediriger avec un message de succès
        return redirect()->route('admin.demande.index')->with('success', 'La demande a bien été mise à jour');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        $demande->delete();
        return to_route('admin.demande.index')->with('success', 'Le demande a bien été Supprimé');
    }
}
