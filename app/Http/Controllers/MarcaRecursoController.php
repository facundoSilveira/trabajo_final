<?php

namespace App\Http\Controllers;

use App\MarcaRecurso;
use Illuminate\Http\Request;

class MarcaRecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos las marcas guardadas en la B.D y visualizarlos
        $marca_recursos = MarcaRecurso::all();
        //compac genera un array con la info que queremos
        return view('marca_recursos.index', compact('marca_recursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca_recursos.create');
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


     $marca = new MarcaRecurso();

    $marca->nombre = $request->nombre ;


     $marca->save();
     return redirect(route('marca_recursos.index'))->with('success','Marca guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarcaRecurso  $marcaRecurso
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaRecurso $marcaRecurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarcaRecurso  $marcaRecurso
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaRecurso $marcaRecurso)
    {
        return view('marca_recursos.edit', compact('marcaRecurso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarcaRecurso  $marcaRecurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarcaRecurso $marcaRecurso)
    {
        $marcaRecurso->fill($request->all());
        $marcaRecurso->update();
        return redirect(route('marca_recursos.index'))->with('success','Marca actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarcaRecurso  $marcaRecurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarcaRecurso $marcaRecurso)
    {
     //
    $marcaRecurso->delete();
    return redirect(route('marca_recursos.index'))->with('success','Marca eliminado con exito!');
    }
    public function storeAjax(Request $request){


        if (request()->ajax()){
            $validator = Validator::make(
                array(
                    'nombre' => $request->get('nombre')
                ),
                array(
                    'nombre' => 'required',
                )
            );

            if ($validator->fails()) {
                return $validator->errors()->all();
            } else {
                $data = [
                    'nombre' => $request->get('nombre'),
                ];
                $marca = MarcaRecurso::create($data);
                return ['1', $marca];
            }
        }
    }
}
