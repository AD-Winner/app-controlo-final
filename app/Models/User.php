<?php

namespace App\Models;
use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use App\Models\Provincia;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_active',
        'provincia_id',
        'regiao_id',
        'sector_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }

    public function regiao(){
        return $this->belongsTo(Regiao::class);
    }

    public function  circulo(){
        return $this->belongsTo(Circulo::class);
    }
    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function kits(){
        return $this->hasMany(Kit::class);
    }
}


