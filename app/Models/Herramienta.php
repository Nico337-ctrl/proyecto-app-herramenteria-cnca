<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\CambioRealizado;

class Herramienta extends Model
{
    use HasFactory;
    protected $table = 'herramientas';

}
