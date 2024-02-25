<?php


// app/Events/HerramientaImported.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HerramientaImported
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $codigo;
    public $descripcion;
    public $estante;
    public $gaveta;
    public $medida;
    public $estado;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($codigo, $descripcion, $estante, $gaveta, $medida, $estado)
    {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->estante = $estante;
        $this->gaveta = $gaveta;
        $this->medida = $medida;
        $this->estado = $estado;
    }
}
