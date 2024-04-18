<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamos';

    protected $fillable = [
        'instructor_prestamista',
        'nombre_aprendiz',
        'ficha_aprendiz',
        'id_aprendiz',
        'dias_por_fuera',
        'observacion',
        'usuario_prestamista',
        'elementos_prestados'
    ];

}


