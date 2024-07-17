<?php

namespace App\Http\Controllers;

use App\Models\MatConsumible;
use Illuminate\Http\Request;
use App\Events\CambioRealizado;
use App\Imports\MatConsumibleImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


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
        return view('matConsumible.create');
    }

    //funcion para generar pdfs
    public function pdf(){
        $matConsumibles = MatConsumible::all();
        $pdf = Pdf::loadView('matConsumible.pdf', ['matConsumibles'=>$matConsumibles]);
        return $pdf->stream();
    }

    //funcion para importe de archivos csv (excel)
    public function import(Request $request){
        $request->validate([
            'document_csv'=> 'required|mimes:csv|max:2408'
        ]);
        $file = $request->file('document_csv');
        Excel::import(new MatConsumibleImport, $file);
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

        $descripcion = $matConsumible->descripcion;
        event(new CambioRealizado('mat_consumible', 'creacion', $descripcion, now()));
        return redirect('matConsumible');
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

        $descripcion = $matConsumible->descripcion;
        event(new CambioRealizado('mat_consumible', 'actualizacion', $descripcion, now()));
        return redirect('matConsumible')->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matConsumible = MatConsumible::find($id);
        $matConsumible->delete();

        $descripcion = $matConsumible->descripcion;
        event(new CambioRealizado('mat_consumible', 'eliminacion', $descripcion, now()));
        return redirect('matConsumible')->with('delete', 'ok');
    }
}
