<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        if($request->cryteria)
        {
            $buscar = $request->buscar;
            $cryteria = $request->cryteria;

            if($buscar==''){
                $ingresos = Ingreso::orderBy('id', 'desc')->paginate(5);
            } else {
                $ingresos = Ingreso::where($cryteria, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(5);
            }

            return [
                'pagination' => [
                    'total'             => $ingresos->total(),
                    'current_page'      => $ingresos->currentPage(),
                    'per_page'          => $ingresos->perPage(),
                    'last_page'         => $ingresos->lastPage(),
                    'from'              => $ingresos->firstItem(),
                    'to'                => $ingresos->lastItem(),
                ],
                'ingresos' => $ingresos
            ];
        } else {
            $ingreso = Ingreso::all();
            return $ingreso;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ingreso = new Ingreso();
        $ingreso->plate = $request->plate;
        $ingreso->brand = $request->brand;
        $ingreso->currentc = $request->currentc;
        $ingreso->preciofinal = 0;
        if($request->initc){
            $ingreso->initc = $request->initc;
        } 
        $ingreso->save();
        return $ingreso;        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ingreso = Ingreso::findOrFail($request->id);
        if($request->plate && $request->brand)
        {
            $ingreso->plate = $request->plate;
            $ingreso->brand = $request->brand;
        }
        if($request->preciofinal && $request->tiempofinal)
        {
            $ingreso->preciofinal = $request->preciofinal;
            $ingreso->tiempofinal = $request->tiempofinal;
            $ingreso->egresado = $request->egresado;
        }
        if ($request->currentc)
        {
            $ingreso->currentc = $request->currentc;
        }
        $ingreso->save();  
    }

    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ingreso = Ingreso::findOrFail($request->id);
        $ingreso->delete();
    }
}