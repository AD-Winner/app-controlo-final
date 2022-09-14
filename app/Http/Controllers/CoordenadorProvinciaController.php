<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Recenseado;
use Illuminate\Http\Request;
use App\Models\Recenseamento;
use Illuminate\Support\Facades\Auth;

class CoordenadorProvinciaController extends Controller
{
    //

    public function kits(){
        $recenseamento = Recenseamento::all()->last();
        $kits = Kit::where('provincia_id', Auth::user()->provincia_id)->get();
        $totKits = Kit::where('provincia_id', Auth::user()->provincia_id)
        ->where('recenseamento_id', $recenseamento->id)->count();

        $m = Recenseado::where('provincia_id', Auth::user()->provincia_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->sum('homem');
            //Soma de mulheres recenseados
        $f = Recenseado::where('provincia_id', Auth::user()->provincia_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->sum('mulher');
       // $totRecenseado = $m + $f;//Soma Total de Recenseados
        return view('coordenadorP.kits', compact('kits', 'recenseamento','totKits','f','m'));
    }
    public function recenseados(){

        try {
            //Recuperação de ultimo recenseamento
            $recenseamento = Recenseamento::all()->last();
            //Recuperação de Kits de Supervisor logado
            $kits = Kit::where('provincia_id', Auth::user()->provincia_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->get();
            //Recuperação de recenseados para supervisor logado
            $recenseados = Recenseado::where('provincia_id', Auth::user()->provincia_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->get();
            //Soma de Homens recenseados
            $m = Recenseado::where('provincia_id', Auth::user()->provincia_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->sum('homem');
            //Soma de mulheres recenseados
            $f = Recenseado::where('provincia_id', Auth::user()->provincia_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->sum('mulher');
            //$tot = $m + $f;//Soma Total de Recenseados
            return view('coordenadorP.recenseado', compact('kits','recenseados', 'recenseamento', 'f','m'));

        } catch (\Throwable $th) {
        //     //throw $th;
            if(config('app.debug')){
                return redirect(route('coordenador.provincial.recenseados'))->with('error', '[ERRO]  Operação abortada!');
            }
                    return redirect(route('coordenador.provincial.recenseados'))->with('error', '[ERRO] Impossivel efetuar operação!');
        }

    }
}
