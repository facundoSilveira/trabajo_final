<?php

namespace App\Http\Controllers;

use App\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $tipoServicios = TipoServicio::all();

       //compac genera un array con la info que queremos
        return view('tipo_servicios.index', compact('tipoServicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoServicios = TipoServicio::all();

        return view('tipo_Servicios.create', compact('tipoServicios'));
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
            'precio' => 'required',
        ]) ;
        //creo una nueva marca y loguardo en la B.D


        $tipoServicio = new TipoServicio();

        $tipoServicio->nombre = $request->nombre ;
        $tipoServicio->descripcion = $request->descripcion ;
        $tipoServicio->precio = $request->precio ;

        $tipoServicio->save();

        return redirect(route('tipo_servicios.index'))->with('success','Tipo Servicio guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoServicio $tipoServicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoServicio $tipoServicio)
    {
        return view('tipo_servicios.edit', compact('tipoServicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoServicio $tipoServicio)
    {
        $tipoServicio->fill($request->all());
        $tipoServicio->update();
        return redirect(route('tipo_servicios.index'))->with('success','Tipo Servicio actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoServicio $tipoServicio)
    {
        $tipoServicio->delete();
        return redirect(route('tipo_servicios.index'))->with('success','Tipo Equipos eliminado con exito!');
    }
}
