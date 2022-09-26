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
use App\Http\Requests\StoreRecenseadoRequest;

class SupervisorController extends Controller
{
    //

    public function dashboard(){
        return view('supervisor.dashboard');
    }
    public function kits(){
        $recenseamento = Recenseamento::all()->last();
        $kits = Kit::where('sector_id', Auth::user()->sector_id)
        ->where('recenseamento_id', $recenseamento->id)
        ->get();
        $tot = Kit::where('sector_id', Auth::user()->sector_id)
        ->where('recenseamento_id', $recenseamento->id)
        ->count();

        $m = Recenseado::where('recenseamento_id', $recenseamento->id)
            ->where('sector_id', Auth::user()->sector_id)
            ->sum('homem');
            //Soma de mulheres recenseados
        $f = Recenseado::where('recenseamento_id', $recenseamento->id)
              ->where('sector_id', Auth::user()->sector_id)
              ->sum('mulher');
        $totRecenseado = $m + $f;//Soma Total de Recenseados
        return view('supervisor.kits', compact('kits', 'recenseamento','tot','totRecenseado'));
    }
    public function recenseados(){

        try {
            //Recuperação de ultimo recenseamento
            $recenseamento = Recenseamento::all()->last();
            //Recuperação de Kits de Supervisor logado
            $kits = Kit::where('sector_id', Auth::user()->sector_id)
            ->where('recenseamento_id', $recenseamento->id)
            ->get();
            //Recuperação de recenseados para supervisor logado
            $recenseados = Recenseado::where('recenseamento_id', $recenseamento->id)
            ->where('sector_id', Auth::user()->sector_id)->get();
            //Soma de Homens recenseados
            $m = Recenseado::where('sector_id', Auth::user()->sector_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->sum('homem');
            //Soma de mulheres recenseados
            $f = Recenseado::where('sector_id', Auth::user()->sector_id)
                ->where('recenseamento_id', $recenseamento->id)
                ->sum('mulher');
            $tot = $m + $f;//Soma Total de Recenseados
            return view('supervisor.recenseado', compact('kits','recenseados', 'tot', 'recenseamento'));

        } catch (\Throwable $th) {
        //     //throw $th;
            if(config('app.debug')){
                return redirect(route('supervisor.recenseados'))->with('error', '[ERRO]  Operação abortada!');
            }
                    return redirect(route('supervisor.recenseados'))->with('error', '[ERRO] Impossivel efetuar operação!');
        }

    }

    public function store(StoreRecenseadoRequest $request){
          //
        // dd($request);
    // try{


        $request->validate([

            'data' => 'required|date',
            'homem' => 'required|integer|max:1000|min:1',
            'mulher' => 'required|integer|max:1000|min:1',

            'recenseamento_id' => 'required|integer|exists:recenseamentos,id',
            'provincia_id' => 'required|integer|exists:provincias,id',
            'regiao_id' => 'required|integer|exists:regiaos,id',
            'circulo_id' => 'required|integer|exists:circulos,id',
            'sector_id' => 'required|integer|exists:sectors,id',
            'kit_id' => 'required|integer|exists:kits,id',
        ]);

        $recenseado = new Recenseado();
        $recenseado->data = $request->data;
        $recenseado->homem = $request->homem;
        $recenseado->mulher = $request->mulher;
        $recenseado->recenseamento_id = $request->recenseamento_id; //Recenseamento
        $recenseado->kit_id = $request->kit_id; // Kit Recenseador
        $recenseado->provincia_id = $request->provincia_id; //
        $recenseado->regiao_id = $request->regiao_id;
        $recenseado->circulo_id = $request->circulo_id;
        $recenseado->sector_id = $request->sector_id;
        $recenseado->save();
        return redirect(route('supervisor.recenseados'))->with('success', '[OK] Dados registados com sucesso.');
    // } catch (\Throwable $th) {
    //     //throw $th;
    //     if(config('app.debug')){
    //         return redirect(route('supervisor.recenseados'))->with('error', '[ERROR] Operação abortada, dados não registos!');
    //     }
    //     return redirect(route('supervisor.recenseados'))->with('error', '[ERROR] Dados não foram registos!');
    // }
    }
    public function destroy(Recenseado $recenseado){
        try {
            //code...
            if($recenseado->delete()){
                return redirect(route('supervisor.recenseados'))->with('success', '[OK] Registo eliminado.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){
                return redirect(route('supervisor.recenseados'))->with('error', '[ERROR] Operação abortada, registo não eliminado!');
            }
            return redirect(route('supervisor.recenseados'))->with('error', '[ERROR] Registo não eliminado!');
        }
    }
}
