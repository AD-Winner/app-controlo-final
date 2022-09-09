<?php

namespace App\Models;

use App\Models\User;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = [
        'provincia'
    ];

    public function circulos(){
       return $this->hasMany(Circulo::class);
    }
    public function regioes(){
       return $this->hasMany(Regiao::class);
    }

    public function sectores(){
        return $this->hasMany(Sector::class);
    }

    public function kits(){
        return $this->hasMany(Kit::class);
    }
    public function recenseados(){
        return $this->hasMany(Recenseado::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
