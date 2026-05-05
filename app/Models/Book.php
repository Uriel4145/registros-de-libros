<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo que representa la tabla 'books' en la base de datos
class Book extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'books';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'titulo',
        'autor',
        'anio_publicacion',
    ];
}
