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
        'user_id',
        'herramienta_id',
        'mat_consumible_id',
        // Otros atributos aquí...
    ];

    public function herramientas()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id', 'id');
    }

    public function matconsumibles()
    {
        return $this->belongsTo(MatConsumible::class, 'mat_consumible_id', 'id');
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Prestamo extends Model
// {
//     use HasFactory;
//     protected $table = 'prestamos';
    
//     public function herramientas(){
//         return $this->belongsTo(Herramienta::class, 'herramienta_id', 'id');
//     }

//     public function matconsumibles(){
//         return $this->belongsTo(MatConsumible::class, 'mat_consumible_id', 'id');
//     }
// }
