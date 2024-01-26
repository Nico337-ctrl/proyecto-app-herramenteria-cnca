<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\MatConsumible;


class PrestamoController extends Controller
{

    public function index()
    {
        $prestamos = Prestamo::all();
        return view('prestamo.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prestamo.create', ['herramientas' => Herramienta::all(), 'mat_consumibles' => MatConsumible::all()]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'instructor_prestamista' => 'required|max:255',
    //         'nombre_aprendiz' => 'required|max:255',
    //         'ficha_aprendiz' => 'required',
    //         'id_aprendiz' => 'required',
    //         'dias_por_fuera' => 'nullable',
    //         'obvervacion' => 'nullable',
    //         'user_id' => 'nullable',
    //         'herramienta_id' => 'nullable',
    //         'matConsumible_id' => 'nullable',
    //     ]);

    //     // Crear una instancia de Prestamo
    //     $prestamo = new Prestamo();
    //     $prestamo->instructor_prestamista = $request->input('instructor_prestamista');
    //     $prestamo->nombre_aprendiz = $request->input('nombre_aprendiz');
    //     $prestamo->ficha_aprendiz = $request->input('ficha_aprendiz');
    //     $prestamo->id_aprendiz = $request->input('id_aprendiz');
    //     $prestamo->dias_por_fuera = 1;
    //     $prestamo->observacion = 'ninguna';
    //     $prestamo->user_id = auth()->user()->id;
    //     $prestamo->herramienta_id = $request->input('herramienta_id');
    //     $prestamo->mat_consumible_id = $request->input('mat_consumible_id');

    //     // Cambiar el estado de la herramienta a "prestado"
    //     $herramienta = Herramienta::find($request->input('herramienta_id'));
    //     $herramienta->estado = 'prestado';
    //     $herramienta->save();

    //     // Cambiar el estado del material consumible a "prestado"
    //     $matConsumible = MatConsumible::find($request->input('mat_consumible_id'));
    //     $matConsumible->estado = 'prestado';
    //     $matConsumible->save();

    //     // Guardar el préstamo en la base de datos
    //     $prestamo->save();

    //     return view('prestamo.msg', ['prestamos' => Prestamo::all(), 'herramientas' => Herramienta::all(), 'mat_consumibles' => MatConsumible::all()]);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'instructor_prestamista' => 'required|max:255',
    //         'nombre_aprendiz' => 'required|max:255',
    //         'ficha_aprendiz' => 'required',
    //         'id_aprendiz' => 'required',
    //         'dias_por_fuera' => 'nullable',
    //         'observacion' => 'nullable',
    //         'user_id' => 'nullable',
    //         'herramienta_id' => 'nullable',
    //         'mat_consumible_id' => 'nullable',
    //     ]);

    //     $prestamo = new Prestamo();
    //     $prestamo->instructor_prestamista = $request->input('instructor_prestamista');
    //     $prestamo->nombre_aprendiz = $request->input('nombre_aprendiz');
    //     $prestamo->ficha_aprendiz = $request->input('ficha_aprendiz');
    //     $prestamo->id_aprendiz = $request->input('id_aprendiz');
    //     $prestamo->dias_por_fuera = 1; // O ajusta según tus necesidades
    //     $prestamo->observacion = 'ninguna'; // O ajusta según tus necesidades
    //     $prestamo->user_id = auth()->user()->id;

    //     // Verificar si se proporciona un 'herramienta_id'
    //     if ($request->has('herramienta_id')) {
    //         $herramienta = Herramienta::find($request->input('herramienta_id'));

    //         if (!$herramienta) {
    //             return redirect()->back()->with('error', 'La herramienta no existe.');
    //         }

    //         $prestamo->herramienta_id = $herramienta->id;
    //         $herramienta->estado = 'prestado';
    //         $herramienta->save();
    //     }

    //     // Verificar si se proporciona un 'mat_consumible_id'
    //     if ($request->has('mat_consumible_id')) {
    //         $matConsumible = MatConsumible::find($request->input('mat_consumible_id'));

    //         if (!$matConsumible) {
    //             return redirect()->back()->with('error', 'El material consumible no existe.');
    //         }

    //         $prestamo->mat_consumible_id = $matConsumible->id;
    //         $matConsumible->estado = 'prestado';
    //         // Agrega la lógica para restar la cantidad del material consumible aquí
    //         $matConsumible->save();
    //     }

    //     $prestamo->save();

    //     return view('prestamo.msg', [
    //         'prestamos' => Prestamo::all(),
    //         'herramientas' => Herramienta::all(),
    //         'mat_consumibles' => MatConsumible::all(),
    //     ]);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'instructor_prestamista' => 'required|max:255',
            'nombre_aprendiz' => 'required|max:255',
            'ficha_aprendiz' => 'required',
            'id_aprendiz' => 'required',
            'dias_por_fuera' => 'nullable',
            'observacion' => 'nullable',
            'user_id' => 'nullable',
            'herramienta_id' => 'nullable',
            'mat_consumible_id' => 'nullable',
            'cantidad' => 'nullable|numeric', // Ajusta según tus requisitos de validación
        ]);
    
        $prestamo = new Prestamo();
        $prestamo->instructor_prestamista = $request->input('instructor_prestamista');
        $prestamo->nombre_aprendiz = $request->input('nombre_aprendiz');
        $prestamo->ficha_aprendiz = $request->input('ficha_aprendiz');
        $prestamo->id_aprendiz = $request->input('id_aprendiz');
        $prestamo->dias_por_fuera = 1;
        $prestamo->observacion = 'ninguna';
        $prestamo->user_id = auth()->user()->id;
        $prestamo->herramienta_id = $request->input('herramienta_id');
        $prestamo->mat_consumible_id = $request->input('mat_consumible_id');
        
        // Restar la cantidad prestada en la tabla MatConsumibles
        if ($request->input('mat_consumible_id')) {
            $matConsumible = MatConsumible::find($request->input('mat_consumible_id'));
            $cantidad = $request->input('cantidad');
    
            // Asegúrate de manejar adecuadamente la lógica de restar la cantidad
            if ($matConsumible && is_numeric($cantidad) && $cantidad > 0) {
                $matConsumible->cantidad -= $cantidad;
                $matConsumible->save();
            }
        }
    
        // Cambiar el estado de la herramienta a "prestado"
        if ($request->input('herramienta_id')) {
            $herramienta = Herramienta::find($request->input('herramienta_id'));
            if ($herramienta) {
                $herramienta->estado = 'prestado';
                $herramienta->save();
            }
        }
    
        $prestamo->save();
    
        return view('prestamo.msg', [
            'prestamos' => Prestamo::all(),
            'herramientas' => Herramienta::all(),
            'mat_consumibles' => MatConsumible::all()
        ]);
    }
    

   
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        return view('prestamo.edit');
    }
    public function update(Request $request, $id)
    {
        // Validar los campos necesarios
        $request->validate([
            'observacion' => 'required|max:450'
        ]);

        // Buscar el préstamo por ID
        $prestamo = Prestamo::find($id);

        // Verificar si el préstamo existe
        if (!$prestamo) {
            return redirect()->route('prestamo.index')->with('error', 'No se encontró el préstamo.');
        }

        // Actualizar la observación en el préstamo
        $prestamo->observacion = $request->input('observacion');

        // Obtener la herramienta asociada al préstamo
        $herramienta = Herramienta::find($prestamo->herramienta_id);

        // Verificar si hay una herramienta asociada
        if ($herramienta) {
            // Cambiar el estado de la herramienta a "disponible"
            $herramienta->estado = 'disponible';
            $herramienta->save();
        }

        // Obtener el material consumible asociado al préstamo
        $matConsumible = MatConsumible::find($prestamo->mat_consumible_id);

        // Verificar si hay un material consumible asociado
        if ($matConsumible) {
            // Cambiar el estado del material consumible a "disponible"
            $matConsumible->estado = 'disponible';
            $matConsumible->save();
        }

        // Guardar los cambios en el préstamo
        $prestamo->save();

        return view('prestamo.msg', ['prestamo' => Prestamo::all()]);
    }
    
    public function destroy($id)
    {
        //
        $prestamo = Prestamo::find($id);
        $prestamo->delete();

        return redirect('prestamo')->with('delete', 'ok');
    }
}
