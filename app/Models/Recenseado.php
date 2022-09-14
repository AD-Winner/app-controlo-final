<?php

namespace App\Models;

use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Provincia;
use App\Models\Recenseamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recenseado extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'homem',
        'mulher',

        'provincia_id',
        'regiao_id',
        'circulo_id',
        'sector_id',
        'recenseamento_id',
        'kit_id',
    ];

    protected $casts =[
        'data' => 'datetime'
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


    public function kit(){
        return $this->belongsTo(Kit::class);
    }
}
