<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Recenseado;
use Illuminate\Http\Request;
use App\Models\Recenseamento;
use Illuminate\Support\Facades\Auth;

class CoordenadorRegionalController extends Controller
{
    //

    public function kits(){
        $recenseamento = Recenseamento::all()->last();
        $kits = Kit::where('regiao_id', Auth::user()->regiao_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->get();
        $totKits = Kit::where('regiao_id', Auth::user()->regiao_id)
              ->where('recenseamento_id', $recenseamento->id)
                ->count();

        $m = Recenseado::where('regiao_id', Auth::user()->regiao_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->sum('homen');
            //Soma de mulheres recenseados
        $f = Recenseado::where('regiao_id', Auth::user()->regiao_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->sum('mulher');
       // $totRecenseado = $m + $f;//Soma Total de Recenseados
        return view('coordenadorR.kits', compact('kits', 'recenseamento','totKits','f','m'));
    }
    public function recenseados(){

        try {
            //Recuperação de ultimo recenseamento
            $recenseamento = Recenseamento::all()->last();
            //Recuperação de Kits de Supervisor logado
            $kits = Kit::where('regiao_id', Auth::user()->regiao_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->get();
            //Recuperação de recenseados para supervisor logado
            $recenseados = Recenseado::where('regiao_id', Auth::user()->regiao_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->get();
            //Soma de Homens recenseados
            $m = Recenseado::where('regiao_id', Auth::user()->regiao_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->sum('homen');
            //Soma de mulheres recenseados
            $f = Recenseado::where('regiao_id', Auth::user()->regiao_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->sum('mulher');
            //$tot = $m + $f;//Soma Total de Recenseados
            return view('coordenadorR.recenseado', compact('kits','recenseados', 'recenseamento', 'f','m'));

        } catch (\Throwable $th) {
        //     //throw $th;
            if(config('app.debug')){
                return redirect(route('coordenador.regional.recenseados'))->with('error', '[ERRO]  Operação abortada!');
            }
                    return redirect(route('coordenador.regional.recenseados'))->with('error', '[ERRO] Impossivel efetuar operação!');
        }

    }
}
