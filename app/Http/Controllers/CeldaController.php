<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Celda;

class CeldaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $celdas = Celda::all();
        return $celdas;
    }
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $celda = new Celda();
        $celda->posicion = $request->posicion;
        $celda->codename = $request->codename;
        $celda->save();        
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $Celda = Celda::findOrFail($request->id);
        $Celda->idingreso = $request->idingreso;
        $Celda->libre = $request->libre;
        if ($request->a_time)
        {
            $Celda->a_time = $request->a_time;
        }
        $Celda->save();  
    }

    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try 
        {
            $celdas = Celda::all()->delete();
            return response()->json('Celda deleted');
        }
        catch(Exception $e) {
            return response()->json($e->getMessage(), 1000);
        }
    }
}
