<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail_stage;
use Illuminate\Http\Request;

class UpdateEtatController extends Controller
{
     public function abondonner($stagiaire)
    {
        // Trouver le stagiaire par le thème
        $stagiaire = Detail_stage::where('theme', $stagiaire)->firstOrFail();
        // $stagiaire = Detail_stage::where('theme', $stagiaire)->with('demande')->firstOrFail();

        // Mettre à jour l'état de la demande du stagiaire
        $stagiaire->demande->update([
            'etat_id' => 6,
        ]);
        return redirect()->back()->with('success', 'abondonner.');
    }
}
