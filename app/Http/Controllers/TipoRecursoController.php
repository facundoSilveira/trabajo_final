<?php

namespace App\Http\Controllers;

use App\TipoRecurso;
use App\Modelo;
use Illuminate\Http\Request;

class TipoRecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $tipoRecursos = TipoRecurso::all();

       //compac genera un array con la info que queremos
        return view('tipo_recursos.index', compact('tipoRecursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoRecursos = TipoRecurso::all();

        return view('tipo_recursos.create', compact('tipoRecursos', 'modelos'));
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


        $tipoRecurso = new TipoRecurso();

        $tipoRecurso->nombre = $request->nombre ;
        $tipoRecurso->descripcion = $request->descripcion ;


        $tipoRecurso->save();
        
        return redirect(route('tipo_recursos.index'))->with('success','Tipo Equipo guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoRecurso  $tipoRecurso
     * @return \Illuminate\Http\Response
     */
    public function show(TipoRecurso $tipoRecurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoRecurso  $tipoRecurso
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoRecurso $tipoRecurso)
    {
        //
        return view('tipo_recursos.edit', compact('tipoRecurso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoRecurso  $tipoRecurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoRecurso $tipoRecurso)
    {
        //
        $tipoRecurso->fill($request->all());
        $tipoRecurso->update();
        return redirect(route('tipo_recursos.index'))->with('success','Tipo Recurso actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoRecurso  $tipoRecurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoRecurso $tipoRecurso)
    {
        //
        $tipoRecurso->delete();
        return redirect(route('tipo_recursos.index'))->with('success','Tipo Equipos eliminado con exito!');
    }
}
