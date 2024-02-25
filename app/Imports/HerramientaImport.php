<?php

namespace App\Imports;

use App\Models\Herramienta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;


class HerramientaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Verifica si 'codigo' está presente y no es nulo antes de intentar insertar en la base de datos
        if (!empty($row['codigo'])) {
            return new Herramienta([
                'codigo' => $row['codigo'],
                'descripcion' => $row['descripcion'] ?? null,
                'estante' => $row['estante'] ?? null,
                'gaveta' => $row['gaveta'] ?? null,
                'medida' => $row['medida'] ?? null,
                'estado' => 'disponible',
            ]);
        } else {
            // Si 'codigo' es nulo, puedes optar por retornar null o manejarlo de alguna otra manera
            Log::debug('Registro omitido debido a un valor nulo en "codigo": ' . json_encode($row));
            return null;
        }
    }

    public function batchSize(): int
    {
        return 10000;
    }

    public function chunkSize(): int
    {
        return 10000;
    }
}
