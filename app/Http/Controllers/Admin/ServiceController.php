<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SearchServiceRequest;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(SearchServiceRequest $request)
    {
        // Commencez par une requête Eloquent vide
        $query = Service::select('services.*')
            ->orderBy('services.created_at', 'desc');

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_service = $request->validated()['nom_service'] ?? null) {
            $query->where('nom_service', 'like', "%{$nom_service}%");
        }
        if ($description_service = $request->validated()['description_service'] ?? null) {
            $query->where('description_service', 'like', "%{$description_service}%");
        }

        // Exécutez la requête et récupérez les résultats
        $services = $query->get();

        return view('admin.services.index', compact('services'));
    }
    /**
     * Display a listing of the resource.
     */
    // public function index(SearchServiceRequest $request)
    // {
    //     $query = Service::query();
    //     if($nom_service = $request->validated('nom_service')){
    //         $query = $query->where('nom_service', 'like', "%{$nom_service}%");
    //     }
    //     if($description_service = $request->validated('description_service')){
    //         $query = $query->where('description_service', 'like', "%{$description_service}%");
    //     }
    //     return view('admin.services.index', [
    //         'services' => $query->get(),
    //         'input' => $request->validated()
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = new Service();
        return view('admin.services.form', [
            'service' => $service
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();
        $service = Service::create($this->extract_data($service, $request));
        return redirect()->route('admin.service.index')->with('success', 'Le service a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.form', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        // Récupérer les données validées depuis la requête
        $data = $this->extract_data($service, $request);

        // Vérifier si un nouveau fichier d'image a été téléchargé
        if ($request->hasFile('image_service')) {
            // Supprimer l'ancienne image si elle existe
            if ($service->image_service) {
                Storage::disk('public')->delete($service->image_service);
            }
            // Enregistrer le nouveau fichier d'image et mettre à jour le chemin dans les données
            $data['image_service'] = $request->file('image_service')->store('file', 'public');
        }

        // Mettre à jour les données du service avec les nouvelles données
        $service->update($data);

        // Redirection avec un message de succès
        return redirect()->route('admin.service.index')->with('success', 'Le service a bien été modifié');
    }



    // private function extract_data(Service $service, ServiceRequest $request)
    // {
    //     $data = $request->validated();
    //     /** @var Uploadedfile|null $image_service */
    //     $image_service = $request->validated('image_service');
    //     if ($image_service == null || $image_service->getError()) {
    //         return $data;
    //     }
    //     if ($service->image_service) {
    //         Storage::disk('public')->delete($service->image_service);
    //     }
    //     $data['image_service'] = $image_service->store('file', 'public');
    //     return $data;
    // }
    // private function extract_data(Service $service, ServiceRequest $request)
    // {
    //     $data = $request->all();
    //     $image_service = $request->file('image_service');
    //     if ($image_service == null || $image_service->getError()) {
    //         return $data;
    //     }
    //     if ($service->image_service) {
    //         Storage::disk('public')->delete($service->image_service);
    //     }
    //     $data['image_service'] = $image_service->store('file', 'public');
    //     return $data;
    // }
    private function extract_data(Service $service, ServiceRequest $request)
    {
        $data = $request->validated(); // Récupérer toutes les données validées

        // Récupérer le fichier d'image de la requête
        $image_service = $request->file('image_service');

        // Vérifier si un nouveau fichier d'image a été téléchargé
        if ($image_service) {
            // Supprimer l'ancienne image si elle existe
            if ($service->image_service) {
                Storage::disk('public')->delete($service->image_service);
            }
            // Enregistrer le nouveau fichier d'image et mettre à jour le chemin dans les données
            $data['image_service'] = $image_service->store('file', 'public');
        }

        return $data; // Retourner les données mises à jour
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return to_route('admin.service.index')->with('success', 'Le service a bien été Supprimé');
    }
}
