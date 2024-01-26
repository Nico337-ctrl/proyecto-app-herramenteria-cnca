<?php
namespace App\Listeners;

use App\Events\CambioRealizado;
use App\Models\Registro;

class CrearRegistro
{
    /**
     * Handle the event.
     *
     * @param  CambioRealizado  $event
     * @return void
     */
    public function handle(CambioRealizado $event)
    {
        // Lógica para crear el registro
        Registro::create([
            'origen' => $event->origen,
            'tipo_cambio' => $event->tipo,
            'elemento_id' => $event->elemento_id,
            'fecha_cambio' => $event->fecha,
            'fecha_registro' => now(),
        ]);
    }
}

