<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'telefono',
        'prefijo',
        'email',
        'contrasena',
        'documento_adverso',
        'documento_reverso',
        'estado',
        'numero_serie',
    ];
}
