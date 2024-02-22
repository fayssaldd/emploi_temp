<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeanceResource;
use App\Models\Formateur;
use App\Models\Group;
use App\Models\Salle;
use App\Models\Seance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

// use Barryvdh\DomPDF\Facade\Pdf;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $seances =  SeanceResource::collection(Seance::all())->groupBy("jour")->map(function ($item){
            return $item->groupBy("periode");
        });
        // $seances = SeanceResource::collection(Seance::all());
        $seances['salles'] = Salle::all();
        // foreach($seances['lundi'] as $fff){
        //     return $fff;
        // }
        // return $seances;
        return view('Seance.index',compact('seances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formateurs = Formateur::all();
        $groups = Group::all();
        $salles = Salle::all();
        return view('Seance.create',compact('formateurs','groups','salles'));
    }
    public function created($id, $periode, $jour)
    {
        $formateurs = Formateur::all();
        $groups = Group::all();
        $salle = Salle::find($id);
        // dd($salle->id);
        return view('Seance.create',compact('formateurs','groups','salle','periode','jour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "periode" => "required|in:1,2,3,4",
            "jour" => "required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi",
            "salle_id" => "required|exists:salles,id",
            "formateur_id" => "required|exists:formateurs,id",
            "group_id" => "required|exists:groups,id",
            "color" => "sometimes|string|max:255",
        ]);

        $seance = Seance::where([
            "periode"=>$formFields["periode"],
            "jour"=>$formFields["jour"],
        ])->where(function ($query) use ($formFields){
            $query->where("formateur_id",$formFields["formateur_id"])
                ->orWhere("group_id",$formFields["group_id"])
                ->orWhere("salle_id",$formFields["salle_id"]);
        })->first();
        if ($seance){
            // return response()->json(["success"=>false,"message"=>"séance existe déjà"
            //     , "seance"=> new SeanceResource($seance)],400);
            return back()->with('warning','Seance est existe déja');
        }

        Seance::create($formFields);
        return to_route('seances.index')->with('success','Seance est bien ajouter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seance $seance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $seance->delete();
        return to_route('seances.index')->with('success','seance est bien supprimer');
    }



    public function print_formateur_emploi(Request $request, string $id)
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
        $data =  ["data"=>$pdf_data,
            "masse_horaire"=>$masse_horaire,
            "formateur"=>$formateur,
            "annee_formation"=>$annee_formation,
        ];
        $pdf = PDF::loadView('pdf.chate_formateurs',$data);
        $pdf->setPaper('A4','landscape');
        return $pdf->download("formateur_$formateur.pdf");
        // return view('pdf.chate_formateurs',$data);

    }

    public function print_groupe_emploi (Request $request, string $id)
    {


        $seances = Seance::where("group_id",$id)->get();

        if($seances->count() == 0){
            return response()->json(["success"=>false,"message"=>"aucune séance trouvée"],400);
        }

        $pdf_data = $seances->groupBy("jour")->map(function ($item){
            return SeanceResource::collection($item)->groupBy("periode");
        });

        # get masse horaire
        $masse_horaire = $seances->count() * 2.5;

        # get groupe name
        $groupe = $seances->first()->group->nom;

        # get formateur name
        $formateur = $seances->first()->formateur->nom . " " . $seances->first()->formateur->prenom;

        # get school year
        $satrt_school_year = date("Y") - 1;
        $end_school_year = date("Y",strtotime("+1 year")) - 1;
        $annee_formation = $satrt_school_year."/".$end_school_year;

        $data = ["data"=>$pdf_data,
            "masse_horaire"=>$masse_horaire,
            "groupe"=>$groupe,
            "annee_formation"=>$annee_formation,
            "formateur"=>$formateur,
        ];

        $pdf = PDF::loadView('pdf.simple',$data);
        $pdf->setPaper('A4','landscape');
        return $pdf->download("group_$groupe.pdf");
    }
}
