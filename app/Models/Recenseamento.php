<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recenseamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'data',
        'estimado',
    ];

    protected $casts =[
        'data' => 'datetime'
    ];


    public function recenseados(){
        return $this->hasMany(Recenseado::class);
    }
    public function kits(){
        return $this->hasMany(Kit::class);
    }
}
