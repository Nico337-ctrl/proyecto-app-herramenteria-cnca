<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HerramientaImport;
use App\Models\Herramienta;
use App\Models\MatConsumible;


class ExcelController extends Controller
{
    //
    public function index()
    {
        return view('excel.index');
    }

    //funcion para importar el archivo xlsx
    public function import(Request $request)
    {
        $request->validate([
            'documento' => 'required|mimes:xlsx|max:5000'
        ]);
        $file = $request->file('documento');
        Excel::import(new HerramientaImport, $file);
        return redirect()->route('excel.index');
    }

    public function export()
    {
    }
}
