<?php

namespace App\Models;

use App\Models\Regiao;
use App\Models\Circulo;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'provincia_id',
        'regiao_id',
        'circulo_id',
        'cod_sector',
        'sector',
    ];



    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }

    public function regiao(){
        return $this->belongsTo(Regiao::class);
    }
    public function circulo(){
        return $this->belongsTo(Circulo::class);
    }

    public function kits(){
        return $this->hasMany(Kit::class);
    }



}
