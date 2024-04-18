<?php

namespace App\Observers;

use App\Models\Herramienta;
use Carbon\Carbon;

class HerramientaObserver
{
    /**
     * Handle the Herramienta "created" event.
     */
    public function created(Herramienta $herramienta): void
    {
        //
    }

    /**
     * Handle the Herramienta "updated" event.
     */
    public function updated(Herramienta $herramienta)
    {
        if ($herramienta->estado === 'disponible' && $herramienta->isDirty('estado')) {
            $prestamo = $herramienta->prestamo;

            if ($prestamo) {
                $fechaPrestamo = Carbon::parse($prestamo->created_at);
                $fechaDevolucion = Carbon::parse($herramienta->updated_at);
                $diasFuera = $fechaPrestamo->diffInDays($fechaDevolucion);

                // Actualiza el campo dias_por_fuera en el préstamo
                $prestamo->update(['dias_por_fuera' => $diasFuera]);
            }
        }
    }

    /**
     * Handle the Herramienta "deleted" event.
     */
    public function deleted(Herramienta $herramienta): void
    {
        //
    }

    /**
     * Handle the Herramienta "restored" event.
     */
    public function restored(Herramienta $herramienta): void
    {
        //
    }

    /**
     * Handle the Herramienta "force deleted" event.
     */
    public function forceDeleted(Herramienta $herramienta): void
    {
        //
    }
}
