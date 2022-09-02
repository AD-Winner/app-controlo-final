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
    ];

    protected $casts =[
        'data' => 'datetime'
    ];
}
