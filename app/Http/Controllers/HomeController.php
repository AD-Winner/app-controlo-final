<?php

namespace App\Http\Controllers;

use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

    }

    public function findRegiaoName (Request $request){
        $data=Regiao::select('cod_regiao','regiao','id')
            ->where('provincia_id', $request->id)->take(100)->get();
            return response()->json($data);
    }
    public function findCirculoName (Request $request){
        $data=Circulo::select('cod_circulo','circulo','id')
            ->where('regiao_id', $request->id)->take(100)->get();
            return response()->json($data);
    }
    public function findSectorName (Request $request){
        $data=Sector::select('cod_sector','sector','id')
            ->where('circulo_id', $request->id)->take(100)->get();
            //It will get Secteur if its id match with cercle id
            return response()->json($data);
    }
    // public function findDistrictName (Request $request){
    //     $data=District::select('district','id', 'cod_district')
    //         ->where('secteur_id', $request->id)
    //         ->orderBY('cod_district', 'ASC')
    //         ->take(200)->get();
    //         //It will get district if its id match with cercle id
    //         return response()->json($data);
    // }
    // public function findBureauName (Request $request){
    //     $data=Bureau::select('bureau','id', 'cod_bureau')
    //         ->where('district_id', $request->id)
    //         ->orderBY('cod_bureau', 'ASC')
    //         ->take(200)->get();
    //         //It will get district if its id match with cercle id
    //         return response()->json($data);
    // }
}
