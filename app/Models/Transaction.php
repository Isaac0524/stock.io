<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['client', 'total_prix', 'user_id', 'receipt_path'];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}