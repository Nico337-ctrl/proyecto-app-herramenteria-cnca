<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;
    protected $table = 'herramientas';

    public function registro()
    {
        return $this->hasMany(Registro::class, 'origen', 'id')->where('origen', 'herramientas');
    }
}
