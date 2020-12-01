<?php

namespace App\Http\Controllers;

use App\Prioridad;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PrioridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Aca voy a obtener todos los Prioridad guardados en la B.D y visualizarlos
         $prioridades = Prioridad::all();
         //compac genera un array con la info que queremos
         return view('prioridades.index', compact('prioridades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prioridades.create');
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


    $prioridad = new Prioridad();

    $prioridad->nombre = $request->nombre ;


    $prioridad->save();
    return redirect(route('prioridades.index'))->with('success','prioridad guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prioridad  $prioridad
     * @return \Illuminate\Http\Response
     */
    public function show(Prioridad $prioridad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prioridad  $prioridad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prioridad = Prioridad::find($id);
        return view('prioridades.edit', compact('prioridad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prioridad  $prioridad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $prioridad = Prioridad::find($id);
        $prioridad->fill($request->all());
        $prioridad->update();
        return redirect(route('prioridades.index'))->with('success','prioridad actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prioridad  $prioridad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prioridad = Prioridad::find($id);
        $prioridad->delete();
        return redirect(route('prioridades.index'))->with('success','prioridad eliminado con exito!');
    }
}
