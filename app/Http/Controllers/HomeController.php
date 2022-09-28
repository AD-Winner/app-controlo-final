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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Models\Role;
use Users;

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

        if(Auth::user()->hasRole('admin')){

                $recenseamento = Recenseamento::all()->last();
                $totalProvincia = Provincia::count(); //Total Provincia
                $totalRegiao = Regiao::count(); //Total Regioes
                $totalSector = Sector::count(); //Total Sectores
                //Total Kits de recenseamento
                $totalKit = Kit::where('recenseamento_id', $recenseamento->id)->count();
                //Total Coordenadores
                $totalCoord = Role::findByName('coordenador-provincia')->count();
                $totalCoordR = Role::findByName('coordenador-regional')->count();
                $totalCoordN = Role::findByName('coordenador-nacional')->count();

                //Total Supervisor
                // $userRoles = User::count($u)
                // $totalSuper = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','admin'])->count();
                $totalSuper = Role::findByName('supervisor')->count();
                $totalAdmin = Role::findByName('admin')->count();
                // $totalAdmin = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','supervisor'])->count();
                // Soma de Homens recenseados
                $h = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
                //Soma de mulheres recenseados
                $m  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
                // dd($mulher);
                $estimad = $recenseamento->estimado; // Recuperação da população estimada
                $estimado = number_format($estimad);
                $totalRecensead = $h + $m; // Soma de Homem e Mulheres
                $homen = number_format($h); //Formatar o numero de homens
                $mulher = number_format($m); //Formatar o numero de mulheres
                $totalRecenseado = number_format($totalRecensead); // Soma de Homem e Mulheres
                $rest = $totalRecensead - $estimad; // Diferença entre Recenseados e Estimação
                $resto = number_format($rest);
                // Calculo de percentual de recenseamento de acordo com estimação
                $pourcentual_total_recenseado = 0;
                    if($estimado != 0){
                        $pourcentual_total_recenseado = number_format(($totalRecensead * 100 / $estimad),2);
                    }
                    $regiaos = Regiao::orderBy('cod_regiao', 'ASC')->with('recenseados')->get();

                    $reg = array(); $totR = array();  //Array para conter dados regionais
                    foreach ($regiaos as $regiao) {
                        $somaRegiao = 0;
                        // echo "Regiao: ".$regiao->regiao." Recenseados :";
                        array_push($reg, $regiao->regiao);
                        foreach ($regiao->recenseados as $recenseado) {
                            # code...
                            $hom = intval($recenseado->homem);
                            $mul = intval($recenseado->mulher);
                            $total = $hom  + $mul;
                            $somaRegiao = $somaRegiao + $total;
                        }
                        array_push($totR, $somaRegiao);
                    }

                    // if(Auth::user()->hasRole('admin')){
                    //     echo("tem");
                    // }
                    // }else{

                        return view('home',
                        compact('totalProvincia','estimado','totalRegiao', 'totalAdmin', 'totalSector','reg', 'totR', 'totalKit', 'regiaos',
                            'recenseamento','mulher','homen', 'totalRecenseado',
                            'pourcentual_total_recenseado', 'resto', 'totalCoord', 'totalSuper'));
        }
        if(Auth::user()->hasRole('coordenador-nacional')){

                $recenseamento = Recenseamento::all()->last();
                $totalProvincia = Provincia::count(); //Total Provincia
                $totalRegiao = Regiao::count(); //Total Regioes
                $totalSector = Sector::count(); //Total Sectores
                //Total Kits de recenseamento
                $totalKit = Kit::where('recenseamento_id', $recenseamento->id)->count();
                //Total Coordenadores
                $totalCoord = Role::findByName('coordenador-provincia')->count();
                $totalCoordR = Role::findByName('coordenador-regional')->count();
                $totalCoordN = Role::findByName('coordenador-nacional')->count();

                //Total Supervisor
                // $userRoles = User::count($u)
                // $totalSuper = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','admin'])->count();
                $totalSuper = Role::findByName('supervisor')->count();
                $totalAdmin = Role::findByName('admin')->count();
                // $totalAdmin = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','supervisor'])->count();
                // Soma de Homens recenseados
                $h = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
                //Soma de mulheres recenseados
                $m  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
                // dd($mulher);
                $estimad = $recenseamento->estimado; // Recuperação da população estimada
                $estimado = number_format($estimad);
                $totalRecensead = $h + $m; // Soma de Homem e Mulheres
                $homen = number_format($h); //Formatar o numero de homens
                $mulher = number_format($m); //Formatar o numero de mulheres
                $totalRecenseado = number_format($totalRecensead); // Soma de Homem e Mulheres
                $rest = $totalRecensead - $estimad; // Diferença entre Recenseados e Estimação
                $resto = number_format($rest);
                // Calculo de percentual de recenseamento de acordo com estimação
                $pourcentual_total_recenseado = 0;
                    if($estimado != 0){
                        $pourcentual_total_recenseado = number_format(($totalRecensead * 100 / $estimad),2);
                    }
                    $regiaos = Regiao::orderBy('cod_regiao', 'ASC')->with('recenseados')->get();

                    $reg = array(); $totR = array();  //Array para conter dados regionais
                    foreach ($regiaos as $regiao) {
                        $somaRegiao = 0;
                        // echo "Regiao: ".$regiao->regiao." Recenseados :";
                        array_push($reg, $regiao->regiao);
                        foreach ($regiao->recenseados as $recenseado) {
                            # code...
                            $hom = intval($recenseado->homem);
                            $mul = intval($recenseado->mulher);
                            $total = $hom  + $mul;
                            $somaRegiao = $somaRegiao + $total;
                        }
                        array_push($totR, $somaRegiao);
                    }

                    // if(Auth::user()->hasRole('admin')){
                    //     echo("tem");
                    // }
                    // }else{

                        return view('home',
                        compact('totalProvincia','estimado','totalRegiao', 'totalAdmin', 'totalSector','reg', 'totR', 'totalKit', 'regiaos',
                            'recenseamento','mulher','homen', 'totalRecenseado',
                            'pourcentual_total_recenseado', 'resto', 'totalCoord', 'totalSuper'));
        }


        if(Auth::user()->hasRole('coordenador-provincia')){
            $recenseamento = Recenseamento::all()->last();
            $totalCirculo = Circulo::where('provincia_id', Auth::user()->provincia_id)->count(); //Total Circulos
            $totalRegiao = Regiao::where('provincia_id', Auth::user()->provincia_id)->count(); //Total Regioes
            $totalSector = Sector::where('provincia_id', Auth::user()->provincia_id)->count(); //Total Sectores
            //Total Kits de recenseamento
            $totalKit = Kit::where('recenseamento_id', $recenseamento->id)
                ->where('provincia_id', Auth::user()->provincia_id)->get()
                ->count();
            //Total Coordenadores
            $totalCoord = Role::where('name', 'coordenador-nacional')
                    ->where('name', 'coordenador-regional')
                    ->where('name', 'coordenador-provincia')
                    ->count();
            // $userRoles = User::count($u)
            $totalSuper = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','admin'])->count();
            $totalAdmin = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','supervisor'])->count();
            // Soma de Homens recenseados
            $h = Recenseado::where('recenseamento_id', $recenseamento->id)
                ->where('provincia_id', Auth::user()->provincia_id)->get()
                ->sum('homem');
            //Soma de mulheres recenseados
            $m  = Recenseado::where('recenseamento_id', $recenseamento->id)
                ->where('provincia_id', Auth::user()->provincia_id)->get()
                ->sum('mulher');


            #--- CALCULAR DADOS A NIVEL NACIONAL ---#
                    //Soma de mulheres recenseados a nivel nacional
                    $homem_g  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
                    $mulher_g  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
                    $total_recenseado_g = $homem_g + $mulher_g;

                    $estimad = $recenseamento->estimado; // Recuperação da população estimada
                    $estimado = number_format($estimad);

                    $totalRecensead = $h + $m; // Soma de Homem e Mulheres
                    $homen = number_format($h); //Formatar o numero de homens
                    $mulher = number_format($m); //Formatar o numero de mulheres
                    $total_provincia = $m + $h;
                    $totalRecenseado = number_format($total_provincia ); // Soma de Homem e Mulheres
                    $rest = $total_recenseado_g - $estimad; // Diferença entre Recenseados e Estimação
                    $resto = number_format($rest);
                    // Calculo de percentual de recenseamento de acordo com estimação
                    $pourcentual_total_recenseado_nacional = 0;
                        if($estimado != 0){
                            $pourcentual_total_recenseado = number_format(($total_recenseado_g * 100 / $estimad),2);
                        }

            return view('home',
            compact('totalCirculo','estimado','totalRegiao', 'totalAdmin', 'totalSector', 'totalKit',
                'recenseamento','mulher','homen', 'totalRecenseado',
                'pourcentual_total_recenseado', 'resto', 'totalCoord', 'totalSuper'));
        }
            // }



    if(Auth::user()->hasRole('coordenador-regional')){
            $recenseamento = Recenseamento::all()->last();
            $totalCirculo = Circulo::where('regiao_id', Auth::user()->regiao_id)->count();
            $totalRegiao = Regiao::where('id', Auth::user()->regiao_id)->count(); //Total Regioes
            $totalSector = Sector::where('regiao_id', Auth::user()->regiao_id)->count(); //Total Sectores
            //Total Kits de recenseamento
            $totalKit = Kit::where('recenseamento_id', $recenseamento->id)
            ->where('regiao_id', Auth::user()->regiao_id)->get()
            ->count();


        // Soma de Homens recenseados
        $h = Recenseado::where('recenseamento_id', $recenseamento->id)
            ->where('regiao_id', Auth::user()->regiao_id)->get()
            ->sum('homem');
        //Soma de mulheres recenseados
        $m  = Recenseado::where('recenseamento_id', $recenseamento->id)
            ->where('regiao_id', Auth::user()->regiao_id)->get()
            ->sum('mulher');


         #--- CALCULAR DADOS A NIVEL NACIONAL ---#
                //Soma de mulheres recenseados a nivel nacional
                $homem_g  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
                $mulher_g  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
                $total_recenseado_g = $homem_g + $mulher_g;

                $estimad = $recenseamento->estimado; // Recuperação da população estimada
                $estimado = number_format($estimad);

                $totalRecensead = $h + $m; // Soma de Homem e Mulheres
                $homen = number_format($h); //Formatar o numero de homens
                $mulher = number_format($m); //Formatar o numero de mulheres
                $total_provincia = $m + $h;
                $totalRecenseado = number_format($total_provincia ); // Soma de Homem e Mulheres
                $rest = $total_recenseado_g - $estimad; // Diferença entre Recenseados e Estimação
                $resto = number_format($rest);
                // Calculo de percentual de recenseamento de acordo com estimação
                $pourcentual_total_recenseado_nacional = 0;
                    if($estimado != 0){
                        $pourcentual_total_recenseado = number_format(($total_recenseado_g * 100 / $estimad),2);
                    }
            return view('home',
            compact('estimado','totalRegiao','totalCirculo', 'totalSector', 'totalKit',
            'recenseamento','mulher','homen', 'totalRecenseado',
            'pourcentual_total_recenseado', 'resto'));
        }//Fin IF

        if (Auth::user()->hasRole('supervisor')){
            $recenseamento = Recenseamento::all()->last();
            // $totalProvincia = Provincia::count(); //Total Provincia
            // $totalRegiao = Regiao::where('id', Auth::user()->regiao_id)->count(); //Total Regioes
            // $totalSector = Sector::where('regiao_id', Auth::user()->regiao_id)->count(); //Total Sectores
            //Total Kits de recenseamento
            $totalKit = Kit::where('recenseamento_id', $recenseamento->id)
            ->where('sector_id', Auth::user()->sector_id)->get()
            ->count();


        // Soma de Homens recenseados
        $h = Recenseado::where('recenseamento_id', $recenseamento->id)
            ->where('sector_id', Auth::user()->sector_id)->get()
            ->sum('homem');
        //Soma de mulheres recenseados
        $m  = Recenseado::where('recenseamento_id', $recenseamento->id)
            ->where('sector_id', Auth::user()->sector_id)->get()
            ->sum('mulher');


         #--- CALCULAR DADOS A NIVEL NACIONAL ---#
                //Soma de mulheres recenseados a nivel nacional
                $homem_g  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
                $mulher_g  = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
                $total_recenseado_g = $homem_g + $mulher_g;

                $estimad = $recenseamento->estimado; // Recuperação da população estimada
                $estimado = number_format($estimad);

                $totalRecensead = $h + $m; // Soma de Homem e Mulheres
                $homen = number_format($h); //Formatar o numero de homens
                $mulher = number_format($m); //Formatar o numero de mulheres
                $total_provincia = $m + $h;
                $totalRecenseado = number_format($total_provincia ); // Soma de Homem e Mulheres
                $rest = $total_recenseado_g - $estimad; // Diferença entre Recenseados e Estimação
                $resto = number_format($rest);
                // Calculo de percentual de recenseamento de acordo com estimação
                $pourcentual_total_recenseado_nacional = 0;
                    if($estimado != 0){
                        $pourcentual_total_recenseado = number_format(($total_recenseado_g * 100 / $estimad),2);
                    }
                return view('home',
                compact('estimado', 'totalKit',
                'recenseamento','mulher','homen', 'totalRecenseado',
                'pourcentual_total_recenseado', 'resto'));
        }
    }//Fim da function


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
}
