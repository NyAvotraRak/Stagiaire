<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail_stage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    public function downloadPdfAttestation($stagiaire)
    {
        // Trouver le stagiaire par le thème
        $stagiaire = Detail_stage::where('theme', $stagiaire)->firstOrFail();
        // $stagiaire = Detail_stage::where('theme', $stagiaire)->with('demande')->firstOrFail();

        // Mettre à jour l'état de la demande du stagiaire
        $stagiaire->demande->update([
            'etat_id' => 5,
        ]);
        // dd($stagiaire->demande->etat_id);
        // Générer le PDF
        $pdf = PDF::loadView('admin.pdf.attestation', [
            'stagiaire' => $stagiaire
        ]);

        // Télécharger le PDF
        // return $pdf->download('attestation.pdf');
        return $pdf->stream();
        // Vous pouvez également utiliser $pdf->stream() pour afficher le PDF dans le navigateur au lieu de le télécharger directement.
    }
}
