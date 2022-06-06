<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cine extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'name', 'surname', 'email',
        'phone', 'about', 'image', 'password',
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function cines() {
        return $this->belongsToMany(Pelicula::class);
    }
}
