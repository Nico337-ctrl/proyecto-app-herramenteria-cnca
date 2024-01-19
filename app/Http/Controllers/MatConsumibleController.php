<?php

namespace App\Http\Controllers;

use App\Models\MatConsumible;
use Illuminate\Http\Request;
use App\Events\CambioRealizado;

class MatConsumibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $matConsumibles = MatConsumible::all();
        return view('matConsumible.index', ['matConsumibles' => $matConsumibles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('matConsumible.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'medida' => 'required',
            'estante' => 'required',
            'gaveta' => 'required',
            'cantidad' => 'required'
        ]);

        $matConsumible = new MatConsumible();
        $matConsumible->codigo = $request->input('codigo');
        $matConsumible->descripcion = $request->input('descripcion');
        $matConsumible->medida = $request->input('medida');
        $matConsumible->estante = $request->input('estante');
        $matConsumible->gaveta = $request->input('gaveta');
        $matConsumible->cantidad = $request->input('cantidad');
        $matConsumible->estado = 'disponible';
        $matConsumible->save();

        event(new CambioRealizado('mat_consumible', 'creacion', now()));
        return view('matConsumible.msg', ['matConsumibles' => MatConsumible::all()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MatConsumible $matConsumible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        // $matConsumible = MatConsumible::find($id);
        // return view('matConsumible.edit', ['matConsumible' => $matConsumible]);
        $matConsumible = MatConsumible::find($id);
        return response()->json($matConsumible);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'medida' => 'required',
            'estante' => 'required',
            'gaveta' => 'required',
            'cantidad' => 'required'
        ]);

        $matConsumible = MatConsumible::find($id);
        $matConsumible->codigo = $request->input('codigo');
        $matConsumible->descripcion = $request->input('descripcion');
        $matConsumible->medida = $request->input('medida');
        $matConsumible->estante = $request->input('estante');
        $matConsumible->gaveta = $request->input('gaveta');
        $matConsumible->cantidad = $request->input('cantidad');
        $matConsumible->save();

        event(new CambioRealizado('mat_consumible', 'actualizacion', now()));
        return view('matConsumible.msg');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matConsumible = MatConsumible::find($id);
        $matConsumible->delete();

        event(new CambioRealizado('mat_consumible', 'eliminacion', now()));
        return redirect('matConsumible')->with('delete', 'ok');
    }
}
