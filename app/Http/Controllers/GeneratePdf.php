<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeanceResource;
use App\Models\Seance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;

class GeneratePdf extends Controller
{
    // public function generateP() {
    //     $data = [
    //         'title' => 'Sample PDF',
    //         'content' => 'This is just a sample PDF content.'
    //     ];
    
    //     $pdf = PDF::loadView('pdf.simple', $data);
    
    //     return $pdf->download('sample.pdf');
    // }

    public function generateP(Request $request, string $id)
    {


        $seances = Seance::where("formateur_id",$id)->get();

        if($seances->count() == 0){
            return response()->json(["success"=>false,"message"=>"aucune séance trouvée"],400);
        }

        $pdf_data = $seances->groupBy("jour")->map(function ($item){
            return SeanceResource::collection($item)->groupBy("periode");
        });

        if (!$pdf_data) {
            return response()->json(["success"=>false,"message"=>"aucune séance trouvée"],400);
        }

        # get masse horaire
        $masse_horaire = $seances->count() * 2.5;

        # get formateur name
        $formateur = $seances->first()->formateur->nom . " " . $seances->first()->formateur->prenom;

        # get school year
        $satrt_school_year = date("Y") - 1;
        $end_school_year = date("Y",strtotime("+1 year")) - 1;
        $annee_formation = $satrt_school_year."/".$end_school_year;
         $da = [
            ["data"=>$pdf_data,
            "masse_horaire"=>$masse_horaire,
            "formateur"=>$formateur,
            "annee_formation"=>$annee_formation,
         ]
        ];
    
        $pdf = PDF::loadView('pdf.chate_formateurs', $da);
    
        return $pdf->download('samjjple.pdf');
    }


    public function downloadPDF()
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $id = 1;
    $seances = Seance::where("formateur_id",$id)->get();

    if($seances->count() == 0){
        return response()->json(["success"=>false,"message"=>"aucune séance trouvée"],400);
    }

    $pdf_data = $seances->groupBy("jour")->map(function ($item){
        return SeanceResource::collection($item)->groupBy("periode");
    });

    if (!$pdf_data) {
        return response()->json(["success"=>false,"message"=>"aucune séance trouvée"],400);
    }

    # get masse horaire
    $masse_horaire = $seances->count() * 2.5;

    # get formateur name
    $formateur = $seances->first()->formateur->nom . " " . $seances->first()->formateur->prenom;

    # get school year
    $satrt_school_year = date("Y") - 1;
    $end_school_year = date("Y",strtotime("+1 year")) - 1;
    $annee_formation = $satrt_school_year."/".$end_school_year;
     $da = [
        ["data"=>$pdf_data,
        "masse_horaire"=>$masse_horaire,
        "formateur"=>$formateur,
        "annee_formation"=>$annee_formation,
     ]
    ];
   
    $html = view('pdf.chate_formateurs', compact('da'))->render();
    $dompdf->loadHtml($html);

    // (Optionnel) Définir la taille du papier et l'orientation
    $dompdf->setPaper('A4', 'landscape');

    // Rendre le PDF
    $dompdf->render();

    // Télécharger le PDF
    return $dompdf->stream('emploi_formateurs.pdf');
}
}
