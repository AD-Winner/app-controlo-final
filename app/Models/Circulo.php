<?php

namespace App\Models;

use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Circulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_circulo',
        'circulo',
        'regiao_id',
        'provincia_id',
    ];


  public function regiao(){
      return $this->belongsTo(Regiao::class);
  }

    public function provincia(){
       return $this->belongsTo(Provincia::class);
    }

    public function sectores(){
        return $this->hasMany(Sector::class);
    }
    public function kits(){
        return $this->hasMany(Kit::class);
    }
}
