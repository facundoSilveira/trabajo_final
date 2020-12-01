<?php

namespace App\Http\Controllers;

use App\Accesorio;
use Illuminate\Http\Request;

class AccesorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los equipos guardados en la B.D y visualizarlos
        $accesorios = Accesorio::all();
        //compac genera un array con la info que queremos
        return view('accesorios.index', compact('accesorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('accesorios.create');
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
            'descripcion' => 'required',
        ]);

        //creo un nuevo accesorio y loguardo en la B.D

        $accesorio = new Accesorio();
        $accesorio->descripcion = $request->descripcion;
        $accesorio->save();
        return redirect(route('accesorios.index'))->with('succcess','Accesorio creado con exito');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function show(Accesorio $accesorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Accesorio $accesorio)
    {
        //
        return view('accesorios.edit', compact('accesorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accesorio $accesorio)
    {
        //
        $accesorio->fill($request->all());
        $accesorio->update();
        return redirect(route('accesorios.index'))->with('success','Accesorio actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accesorio $accesorio)
    {
        //
        $accesorio->delete();
        return redirect(route('accesorios.index'))->with('success','Accesorio eliminado con exito!');
    }
}
