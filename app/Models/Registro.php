<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'origen',
        'tipo_cambio',
        'elemento_id',
        'fecha',

    ];

    public function herramienta()
    {
    return $this->hasOne(Herramienta::class, 'id', 'origen');
    }

    public function matConsumible()
    {
    return $this->hasOne(MatConsumible::class, 'id', 'origen');
    }

    public function registro()
    {
    return $this->hasMany(Registro::class, 'origen', 'id');
    }
}
