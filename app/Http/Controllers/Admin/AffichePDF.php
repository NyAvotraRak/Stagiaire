<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class AffichePDF extends Controller
{
    public function readPDF($lm)
    {

        $cheminPDF = public_path('storage/file/' . $lm);

        if (File::exists($cheminPDF)) {
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $lm . '"',
            ];

            return Response::file($cheminPDF, $headers);
        } else {
            abort(404);
        }
    }
}
