<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MatConsumible extends Model
{
    use HasFactory;
    protected $table = 'mat_consumibles';

    protected $fillable = [
        'codigo',
        'descripcion',
        'estante',
        'gaveta',
        'medida',
        'cantidad',
        'estado'
    ];

    public function registro()
    {
        return $this->hasMany(Registro::class, 'origen', 'id')->where('origen', 'mat_consumibles');
    }

    public function megaInventario()
    {
        return $this->belongsTo(Mega_Inventario::class);
    }
}

