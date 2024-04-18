<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;
    protected $table = 'herramientas';

    protected $fillable = [
        'codigo',
        'descripcion',
        'estante',
        'gaveta',
        'medida',
        'estado'
    ];

    public function registro()
    {
        return $this->hasMany(Registro::class, 'origen', 'id')->where('origen', 'herramientas');
    }

    public function Mega_inventario()
    {
        return $this->belongsTo(Mega_inventario::class);
    }
}
