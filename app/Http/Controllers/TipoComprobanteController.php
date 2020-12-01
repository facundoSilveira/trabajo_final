<?php

namespace App\Http\Controllers;

use App\TipoComprobante;
use Illuminate\Http\Request;

class TipoComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $tipo_comprobantes = TipoComprobante::all();

       //compac genera un array con la info que queremos
        return view('tipo_comprobantes.index', compact('tipo_comprobantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_comprobantes.create');
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

        ]) ;
        //creo una nueva marca y loguardo en la B.D


        $tipo_comprobante = new TipoComprobante();

        $tipo_comprobante->nombre = $request->nombre ;


        $tipo_comprobante->save();
        return redirect(route('tipo_comprobantes.index'))->with('success','Tipo comprobante guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoComprobante  $tipoComprobante
     * @return \Illuminate\Http\Response
     */
    public function show(TipoComprobante $tipoComprobante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoComprobante  $tipoComprobante
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoComprobante $tipoComprobante)
    {
        //
        return view('tipo_comprobantes.edit', compact('tipoComprobante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoComprobante  $tipoComprobante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoComprobante $tipoComprobante)
    {
        //
        $tipoComprobante->fill($request->all());
        $tipoComprobante->update();
        return redirect(route('tipo_comprobantes.index'))->with('success','Tipo Comprobanteactualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoComprobante  $tipoComprobante
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoComprobante $tipoComprobante)
    {
        $tipoComprobante->delete();
        return redirect(route('tipo_comprobantes.index'))->with('success','Tipo Comprobante eliminado con exito!');
    }
}
