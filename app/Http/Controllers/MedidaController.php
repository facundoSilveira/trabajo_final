<?php

namespace App\Http\Controllers;

use App\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos las marcas guardadas en la B.D y visualizarlos
        $medidas = Medida::all();
        //compac genera un array con la info que queremos
        return view('medidas.index', compact('medidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medidas.create');
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


    $medidas = new Medida();

    $medidas->nombre = $request->nombre ;


    $medidas->save();
    return redirect(route('medidas.index'))->with('success','medidas guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function show(Medida $medida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function edit(Medida $medida)
    {
        return view('medidas.edit', compact('medida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medida $medida)
    {
        $medida->fill($request->all());
        $medida->update();
        return redirect(route('medidas.index'))->with('success','Marca actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medida $medida)
    {
        $medida->delete();
        return redirect(route('medidas.index'))->with('success','Marca eliminado con exito!');
    }
}
