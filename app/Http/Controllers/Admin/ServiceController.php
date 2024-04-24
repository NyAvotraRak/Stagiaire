<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SearchServiceRequest;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchServiceRequest $request)
    {
        $query = Service::query();
        if($nom_service = $request->validated('nom_service')){
            $query = $query->where('nom_service', 'like', "%{$nom_service}%");
        }
        if($description_service = $request->validated('description_service')){
            $query = $query->where('description_service', 'like', "%{$description_service}%");
        }
        return view('admin.services.index', [
            'services' => $query->get(),
            'input' => $request->validated()
        ]);
    }

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
        $service = Service::create($request->validated());
        return to_route('admin.service.index')->with('success', 'Le service a bien été crée');
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
        $service->update($request->validated());
        return to_route('admin.service.index')->with('success', 'Le service a bien été modifié');
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
