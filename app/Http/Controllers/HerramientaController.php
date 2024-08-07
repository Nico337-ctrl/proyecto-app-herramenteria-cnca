<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Events\CambioRealizado;
use Barryvdh\DomPDF\Facade\Pdf;





class HerramientaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $herramientas = Herramienta::all();
        return view('herramienta.index', ['herramientas' => $herramientas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('herramienta.create');
    }

    //funcion para generar pdfs
    public function pdf()
    {
        $herramientas = Herramienta::all();
        $pdf = Pdf::loadView('herramienta.pdf', ['herramientas' => $herramientas]);
        return $pdf->stream();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'medida' => 'required',
            'estante' => 'required',
            'gaveta' => 'required',
        ]);

        $herramientas = new Herramienta();
        $herramientas->codigo = $request->input('codigo');
        $herramientas->descripcion = $request->input('descripcion');
        $herramientas->medida = $request->input('medida');
        $herramientas->estante = $request->input('estante');
        $herramientas->gaveta = $request->input('gaveta');
        $herramientas->estado = 'disponible';
        $herramientas->save();

        $descripcion = $herramientas->descripcion;
        event(new CambioRealizado('herramienta', 'creacion', $descripcion, now()));
        return redirect('herramienta')->with('succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Herramienta $herramienta)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $herramientas = Herramienta::find($id);
        return view('herramienta.edit', ['herramientas' => $herramientas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'medida' => 'required',
            'estante' => 'required',
            'gaveta' => 'required',
        ]);

        $herramienta = Herramienta::find($id);
        $herramienta->codigo = $request->input('codigo');
        $herramienta->descripcion = $request->input('descripcion');
        $herramienta->medida = $request->input('medida');
        $herramienta->estante = $request->input('estante');
        $herramienta->gaveta = $request->input('gaveta');
        $herramienta->save();

        $descripcion = $herramienta->descripcion;
        //haciendo llamado al evento obteniendo: origen, tipo_cambio, elemento_id y fecha (now(()))
        event(new CambioRealizado('herramienta', 'actualizacion', $descripcion, now()));
        return redirect('herramienta')->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $herramienta = Herramienta::find($id);
        $herramienta->delete();

        $descripcion = $herramienta->descripcion;

        event(new CambioRealizado('herramienta', 'eliminacion', $descripcion, now()));
        return redirect('herramienta')->with('delete', 'ok');
    }
}
