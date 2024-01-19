<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MatConsumible extends Model
{
    use HasFactory;
    protected $table = 'mat_consumibles';

    public function registro()
    {
        return $this->hasMany(Registro::class, 'origen', 'id')->where('origen', 'mat_consumibles');
    }
}

