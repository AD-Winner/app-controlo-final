<?php

namespace App\Models;

use App\Models\Kit;
use App\Models\Sector;
use App\Models\Recenseado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regiao extends Model
{
    use HasFactory;
    protected $table ='regiaos';

    protected $fillable = [
        'cod_regiao',
        'regiao',
        'provincia_id',
    ];


    public function circulos(){
        return $this->hasMany(Circulo::class);
    }
    public function sectores(){
        return $this->hasMany(Sector::class);
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
    public function kits(){
        return $this->hasMany(Kit::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    public function recenseados(){
        return $this->hasMany(Recenseado::class);
    }


}
