<?php

namespace App\Models;

use App\Models\User;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Recenseado;
use App\Models\Recenseamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [

        'numero',
        'descricao',

        'provincia_id',
        'regiao_id',
        'circulo_id',
        'sector_id',
        'recenseamento_id',


    ];



    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
    public function  regiao(){
        return $this->belongsTo(Regiao::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function recenseamento(){
        return $this->belongsTo(Recenseamento::class);
    }

    public function recenseados(){
        return $this->hasMany(Recenseado::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
