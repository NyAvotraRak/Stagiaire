<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DemandeRequest;
use App\Http\Requests\Admin\SearchDemandeRequest;
use App\Mail\DemandeContactMail;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    // public function __construct()
    // {
    //     dd('dfsdff');
    //     $this->authorizeResource(Demande::class, 'demande');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(SearchDemandeRequest $request)
    {
        $nom_demande = $request->input('nom_demande');
        $prenom_demande = $request->input('prenom_demande');
        // Commencez par une requête Eloquent vide
        $query = Demande::select('demandes.*', 'services.nom_service', 'etats.nom_etat', 'niveaux.nom_niveau')
            ->join('services', 'demandes.service_id', '=', 'services.id')
            ->join('etats', 'demandes.etat_id', '=', 'etats.id')
            ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
            ->whereIn('etats.nom_etat', ['En attente', 'Entretien'])
            ->orderBy('etats.id', 'desc');

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_demande = $request->validated()['nom_demande'] ?? null) {
            $query->where('nom_demande', 'like', "%{$nom_demande}%");
        }

        // Vérifiez si le prenom_demande est présent dans les données validées
        if ($prenom_demande = $request->validated()['prenom_demande'] ?? null) {
            $query->where('prenom_demande', 'like', "%{$prenom_demande}%");
        }

        // Exécutez la requête et récupérez les résultats
        $demandes = $query->get();

        // Compter le nombre total de demandes
        $nombre_demandes = $demandes->count();

        // Initialiser les nombres d'état à zéro
        $nombre_etat_id_1 = 0;
        $nombre_etat_id_2 = 0;
        // Initialiser les pourcentages à zéro
        $pourcentage_etat_id_1 = 0;
        $pourcentage_etat_id_2 = 0;

        // Vérifier si le nombre total de demandes est différent de zéro avant de calculer les pourcentages
        if ($nombre_demandes > 0) {
            // Compter le nombre de demandes avec etat_id égal à 1
            $nombre_etat_id_1 = $demandes->where('etat_id', 1)->count();
            // Compter le nombre de demandes avec etat_id égal à 2
            $nombre_etat_id_2 = $demandes->where('etat_id', 2)->count();
            // Calcul du pourcentage de demandes avec etat_id égal à 1 par rapport au nombre total de demandes
            $pourcentage_etat_id_1 = ($nombre_etat_id_1 / $nombre_demandes) * 100;
            // Calcul du pourcentage de demandes avec etat_id égal à 2 par rapport au nombre total de demandes
            $pourcentage_etat_id_2 = ($nombre_etat_id_2 / $nombre_demandes) * 100;
        }

        // Passer les nombres de demandes à la vue
        return view('admin.demandes.index', compact('demandes', 'nombre_demandes', 'nombre_etat_id_1', 'nombre_etat_id_2', 'pourcentage_etat_id_1', 'pourcentage_etat_id_2', 'prenom_demande', 'nom_demande'));
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
        if (Auth::user()->fonction->service->nom_service != $demande->service->nom_service) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé a accepter cette demande car elle n\'est pas dans votre service.');
        }
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
        if (Auth::user()->fonction->service->nom_service != $demande->service->nom_service) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé a supprimer cette demande car elle n\'est pas dans votre service.');
        }
        // dd($demande->id);
        $demande->delete();
        return to_route('admin.demande.index')->with('success', 'Le demande a bien été Supprimé');
    }
}
