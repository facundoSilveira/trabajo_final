<?php

namespace App\Http\Controllers;

use App\TipoMovimiento;
use Illuminate\Http\Request;

class TipoMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $tipo_movimientos = TipoMovimiento::all();

       //compac genera un array con la info que queremos
        return view('tipo_movimientos.index', compact('tipo_movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_movimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validaciones
         $data = request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]) ;
        //creo una nueva marca y loguardo en la B.D


        $tipo_movimiento = new TipoMovimiento();

        $tipo_movimiento->nombre = $request->nombre ;
        $tipo_movimiento->descripcion = $request->descripcion ;


        $tipo_movimiento->save();
        return redirect(route('tipo_movimientos.index'))->with('success','Tipo movimiento guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoMovimiento $tipoMovimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMovimiento $tipoMovimiento)
    {
        return view('tipo_movimientos.edit', compact('tipoMovimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMovimiento $tipoMovimiento)
    {
        $tipoMovimiento->fill($request->all());
        $tipoMovimiento->update();
        return redirect(route('tipo_movimientos.index'))->with('success','Tipo Movimiento actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMovimiento $tipoMovimiento)
    {
        $tipoMovimiento->delete();
        return redirect(route('tipo_movimientos.index'))->with('success','Tipo Movimiento eliminado con exito!');
    }
}
