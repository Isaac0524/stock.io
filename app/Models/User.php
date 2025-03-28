<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function ventes()
    {
        return $this->hasMany(Vente::class);  // Un utilisateur a plusieurs ventes
    }
}

