<?php

namespace App\Http\Controllers;

use App\Modelo;
use App\TipoRecurso;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $modelos = Modelo::all();
        //compac genera un array con la info que queremos
        return view('modelos.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_recursos = TipoRecurso::all();
        return view('modelos.create', compact('modelos','tipo_recursos'));
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


            $modelo = new Modelo();

            $modelo->nombre = $request->nombre ;
            $modelo->tipo_recurso_id = $request->tipo_recurso_id;
            $modelo->save();
            //$modelo->tipo_recurso()->sync($request->tipo_recurso_id);
            return redirect(route('modelos.index'))->with('success','modelo guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        return view('modelos.edit', compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo $modelo)
    {
        //
        $modelo->fill($request->all());
        $modelo->update();
        return redirect(route('modelos.index'))->with('success','modelo actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo $modelo)
    {
        $modelo->delete();
        return redirect(route('modelos.index'))->with('success','modelo eliminado con exito!');
    }
}
