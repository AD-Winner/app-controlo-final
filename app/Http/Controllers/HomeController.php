<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use App\Models\Provincia;
use App\Models\Recenseado;
use Illuminate\Http\Request;
use App\Models\Recenseamento;
use Spatie\Permission\Models\Role;

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
        $recenseamento = Recenseamento::all()->last();
        $totalProvincia = Provincia::count(); //Total Provincia
        $totalRegiao = Regiao::count(); //Total Regioes
        $totalSector = Sector::count(); //Total Sectores
        //Total Kits de recenseamento
        $totalKit = Kit::where('recenseamento_id', $recenseamento->id)->count();
        //Total Coordenadores
        $totalCoord = Role::whereNotIn('name', ['admin', 'dev','supervisor'])->count();
        //Total Supervisor
        $totalSuper = Role::whereIn('name', ['coodenador-nacional','coodenador-regional', 'coodenador-provincia', 'dev','admin'])->count();
        // Soma de Homens recenseados
        $homen = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
        //Soma de mulheres recenseados
        $mulher = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
        $estimado = $recenseamento->estimado; // Recuperação da população estimada
        $totalRecenseado = $homen + $mulher; // Soma de Homem e Mulheres
        $resto = $totalRecenseado - $estimado; // Diferença entre Recenseados e Estimação
        // Calculo de percentual de recenseamento de acordo com estimação
        $pourcentual_total_recenseado = 0;
            if($estimado != 0){
                $pourcentual_total_recenseado = number_format(($totalRecenseado * 100 / $estimado),2);
            }

            // $regiaoDados = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homen');
            // dd($regiaoDados);
        $dados_Regiao = Recenseado::select(Recenseado::raw('sum(homem + mulher) as total, regiao_id'))
            ->where('recenseamento_id', '=', $recenseamento->id)
            ->with('regiao')
            ->groupBy('regiao_id')
            ->get();
            foreach ($dados_Regiao as $regiao) {
                # code...
                echo $regiao->regiao->regiao. " " .$regiao->total ."<br>";
            }

            // ->orderBy('homen','DESC')
            // ->get();
            // dd($soma_dados_Regiao);
        return view('home',
        compact('totalProvincia','totalRegiao','totalSector', 'totalKit',
            'recenseamento', 'mulher','homen', 'totalRecenseado',
            'pourcentual_total_recenseado', 'resto', 'totalCoord', 'totalSuper'));

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
