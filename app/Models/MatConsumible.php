<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\CambioRealizado;

class MatConsumible extends Model
{
    use HasFactory;
    protected $table = 'mat_consumibles';

}

