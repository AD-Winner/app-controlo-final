<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Recenseado;
use Illuminate\Http\Request;
use App\Models\Recenseamento;

class CoordenadorNacionalController extends Controller
{
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
