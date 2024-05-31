<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FonctionRequest;
use App\Http\Requests\Admin\SearchFonctionRequest;
use App\Models\Fonction;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FonctionController extends Controller
{
    public function index(SearchFonctionRequest $request)
    {
        $nom_fonction = $request->input('nom_fonction');
        $role = $request->input('role');

        // Récupérer toutes les fonctions avec leurs services associés, triées par date de création décroissante
        $query = Fonction::with('service')->orderBy('created_at', 'desc');

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_fonction = $request->validated()['nom_fonction'] ?? null) {
            $query->where('nom_fonction', 'like', "%{$nom_fonction}%");
        }

        // Vérifiez si le prenom_demande est présent dans les données validées
        if ($role = $request->validated()['role'] ?? null) {
            $query->where('role', 'like', "%{$role}%");
        }

        // Exécutez la requête et récupérez les résultats
        $fonctions = $query->get();

        // Compter le nombre total de fonctions
        $totalFonctions = $fonctions->count();

        // Compter le nombre total de fonctions par service en tenant compte des critères de recherche
        $fonctionsParService = Fonction::select('service_id', DB::raw('count(*) as total'))
            ->when($nom_fonction, function ($query, $nom_fonction) {
                return $query->where('nom_fonction', 'like', "%{$nom_fonction}%");
            })
            ->when($role, function ($query, $role) {
                return $query->where('role', 'like', "%{$role}%");
            })
            ->groupBy('service_id')
            ->get();

        // Calculer le pourcentage pour chaque service
        foreach ($fonctionsParService as $fonctionParService) {
            if ($totalFonctions != 0) {
                $fonctionParService->pourcentage = ($fonctionParService->total / $totalFonctions) * 100;
            } else {
                $fonctionParService->pourcentage = 0;
            }
        }

        // Récupérer tous les services
        $services = Service::all();

        return view('admin.fonctions.index', compact('fonctions', 'nom_fonction', 'role', 'totalFonctions', 'fonctionsParService', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fonction = new Fonction();
        $servicesSelectionnes = []; // Initialiser la variable
        return view('admin.fonctions.form', [
            'fonction' => $fonction,
            'services' => Service::pluck('nom_service', 'id'),
            'servicesSelectionnes' => $servicesSelectionnes // Passer la variable à la vue
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FonctionRequest $request)
    {
        // $fonction = Fonction::create($request->validated());

        $validated = $request->validated();
        $serviceIds = $validated['service_id'];
        // dd($serviceIds);

        $roles = $validated['role'];

        // Vérifier si le rôle sélectionné est "Administrateur" et si plusieurs services sont sélectionnés
        if ($roles === 'Administrateur' && count($serviceIds) > 1) {
            return redirect()->back()->withErrors(['role' => 'Vous ne pouvez pas sélectionner plusieurs services pour un rôle Administrateur.'])->withInput();
        }

        foreach ($serviceIds as $serviceId) {
            Fonction::create([
                'nom_fonction' => $validated['nom_fonction'],
                'role' => $validated['role'],
                'service_id' => $serviceId,
            ]);
        }
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été crée');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonction $fonction)
    {
        // Récupérer les services liés à cette fonction spécifique
        $servicesSelectionnes = $fonction->service()->pluck('id')->toArray();
        return view('admin.fonctions.form', [
            'fonction' => $fonction,
            'services' => Service::pluck('nom_service', 'id'),
            'servicesSelectionnes' => $servicesSelectionnes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(FonctionRequest $request, Fonction $fonction)
    // {
    //     dd($request);
    //     // Valider les données de la requête
    //     $validatedData = $request->validated();

    //     // Récupérer les IDs des services sélectionnés à partir des données validées
    //     $servicesIds = $validatedData['service_id'];

    //     foreach ($servicesIds as $serviceId) {
    //         Fonction::create([
    //             'nom_fonction' => $validatedData['nom_fonction'],
    //             'role' => $validatedData['role'],
    //             'service_id' => $serviceId,
    //         ]);
    //     }
    //     return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été modifié');
    // }
    public function update(FonctionRequest $request, Fonction $fonction)
    {
        // dd($request);

        // // $fonction->delete();
        // // Valider les données de la requête
        // $validatedData = $request->validated();

        // // Récupérer les IDs des services sélectionnés à partir des données validées
        // $servicesIds = $validatedData['service_id'];

        // $roles = $validatedData['role'];

        // // Vérifier si le rôle sélectionné est "Administrateur" et si plusieurs services sont sélectionnés
        // if ($roles === 'Administrateur' && count($servicesIds) > 1) {
        //     return redirect()->back()->withErrors(['role' => 'Vous ne pouvez pas sélectionner plusieurs services pour un rôle Administrateur.'])->withInput();
        // }

        // foreach ($servicesIds as $serviceId) {
        //     Fonction::create([
        //         'nom_fonction' => $validatedData['nom_fonction'],
        //         'role' => $validatedData['role'],
        //         'service_id' => $serviceId,
        //     ]);
        // }

        // Mettre à jour le niveau
        $fonction->update($request->validated());
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fonction $fonction)
    {
        // dd($fonction->id);
        $fonction->delete();
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été Supprimé');
    }
}
