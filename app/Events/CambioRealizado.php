<?php
// app/Events/CambioRealizado.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CambioRealizado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $origen;
    public $tipo;
    public $elemento_id;
    public $fecha;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($origen, $tipo, $elemento_id, $fecha)
    {
        $this->origen = $origen;
        $this->tipo = $tipo;
        $this->elemento_id = $elemento_id;
        $this->fecha = $fecha;
    }
}
