<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;

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
        // if (auth()->user()->hasRole('Admin')) {
        //     return view('herramienta.create');
        // } elseif (auth()->user()->hasRole('Regular')) {
        //     abort(403, 'No tienes permisos de administrador para realizar esta acción. Solo los administradores pueden crear herramientas.');
        // } else {
        //     abort(403, 'No tienes permisos para realizar esta acción.');
        // }
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


        return view('herramienta.msg', ['herramientas' => Herramienta::all()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Herramienta $herramienta)
    {
        // no se que e'
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

        return view('herramienta.msg');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $herramienta = Herramienta::find($id);
        $herramienta->delete();

        return redirect('herramienta')->with('delete', 'ok');
    }
}
