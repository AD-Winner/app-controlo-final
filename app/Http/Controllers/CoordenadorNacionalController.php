<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Provincia;
use App\Models\Recenseado;
use Illuminate\Http\Request;
use App\Models\Recenseamento;
use Spatie\Permission\Models\Role;

class CoordenadorNacionalController extends Controller
{

    public function index()
    {
        $recenseamento = Recenseamento::all()->last();
        $totalProvincia = Provincia::count(); //Total Provincia
        $totalRegiao = Regiao::count(); //Total Regioes
        $totalSector = Sector::count(); //Total Sectores
        //Total Kits de recenseamento
        $totalKit = Kit::where('recenseamento_id', $recenseamento->id)->count();
        //Total Coordenadores
        $totalCoord = Role::where('name', 'coordenador-nacional')
                ->where('name', 'coordenador-regional')
                ->where('name', 'coordenador-provincia')
                ->count();
        // $userRoles = User::count($u)
        $totalSuper = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','admin'])->count();
        $totalAdmin = Role::whereNotIn('name', ['coordenador-nacional','coordenador-regional', 'coordenador-provincia', 'dev','supervisor'])->count();
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

        return view('home',
         compact('totalProvincia','estimado','totalRegiao', 'totalAdmin', 'totalSector','reg', 'totR', 'totalKit', 'regiaos',
            'recenseamento','mulher','homen', 'totalRecenseado',
            'pourcentual_total_recenseado', 'resto', 'totalCoord', 'totalSuper'));

    }
    //
    public function kits(){
        $recenseamento = Recenseamento::all()->last();
        $kits = Kit::where('recenseamento_id', $recenseamento->id)->get();
        $totKits = Kit::where('recenseamento_id', $recenseamento->id)->count();

        $m = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
            //Soma de mulheres recenseados
        $f = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
       // $totRecenseado = $m + $f;//Soma Total de Recenseados
        return view('coordenadorN.kits', compact('kits', 'recenseamento','totKits','f','m'));
    }
    public function recenseados(){

        try {
            //Recuperação de ultimo recenseamento
            $recenseamento = Recenseamento::all()->last();
            //Recuperação de Kits
            $kits = Kit::where('recenseamento_id', $recenseamento->id)->get();
            //Recuperação de recenseados
            $recenseados = Recenseado::where('recenseamento_id', $recenseamento->id)->get();
            //Soma de Homens recenseados
            $m = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('homem');
            //Soma de mulheres recenseados
            $f = Recenseado::where('recenseamento_id', $recenseamento->id)->sum('mulher');
            return view('coordenadorN.recenseado', compact('kits','recenseados', 'recenseamento', 'f','m'));

        } catch (\Throwable $th) {
        //     //throw $th;
            if(config('app.debug')){
                return redirect(route('coordenador.nacional.recenseados'))->with('error', '[ERRO]  Operação abortada!');
            }
                    return redirect(route('coordenador.nacional.recenseados'))->with('error', '[ERRO] Impossivel efetuar operação!');
        }

    }
}
