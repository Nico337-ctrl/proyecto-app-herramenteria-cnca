<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\MatConsumible;
use App\Models\Prestamo;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $totalHerramientas = Herramienta::count();
        $herramientasDisponibles = Herramienta::where('estado', 'disponible')->count();
        $totalMateriales = MatConsumible::count();
        $materialesDisponibles = MatConsumible::where('estado', 'disponible')->count();
        $totalPrestamos = Prestamo::count();

        if ($totalHerramientas > 0) {
            $porHerraDispo = ($herramientasDisponibles / $totalHerramientas) * 100;
        } else {
            $porHerraDispo = 0; // Evitar división por cero
        }

        return view('home', ['herramientasDisponibles' => $herramientasDisponibles, 
                            'materialesDisponibles' => $materialesDisponibles, 
                            'totalPrestamos' => $totalPrestamos, 
                            'porHerraDispo' => $porHerraDispo, 
                            'totalHerramientas' => $totalHerramientas,
                            'totalMateriales' => $totalMateriales]);
    }
}
