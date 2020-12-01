<?php

namespace App\Http\Controllers;

use App\TipoEquipo;

use Illuminate\Http\Request;

class TipoEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $tipo_equipos = TipoEquipo::all();

       //compac genera un array con la info que queremos
        return view('tipo_equipos.index', compact('tipo_equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tipo_equipos.create');
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


        $tipo_equipo = new TipoEquipo();

        $tipo_equipo->nombre = $request->nombre ;


        $tipo_equipo->save();
        return redirect(route('tipo_equipos.index'))->with('success','Tipo Equipo guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoEquipo $tipoEquipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoEquipo $tipoEquipo)
    {
        //
        return view('tipo_equipos.edit', compact('tipoEquipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoEquipo $tipoEquipo)
    {
        $tipoEquipo->fill($request->all());
        $tipoEquipo->update();
        return redirect(route('tipo_equipos.index'))->with('success','Tipo Equipo actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoEquipo $tipoEquipo)
    {
        $tipoEquipo->delete();
        return redirect(route('tipo_equipos.index'))->with('success','Tipo Equipos eliminado con exito!');
    }
}
