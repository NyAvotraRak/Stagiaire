<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail_stage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    public function downloadPdfAttestation($stagiaire_theme, $stagiaire_date_fin)
    {
        $stagiaire = Detail_stage::where('theme', $stagiaire_theme)->firstOrFail();
        $stagiaire->demande->update([
            'etat_id' => 5,
        ]);
        $pdf = Pdf::loadView('admin.pdf.attestation', [
            'stagiaire' => $stagiaire
        ]);
        return $pdf->download('attestation.pdf');
        // return $pdf->stream();
    }
}
