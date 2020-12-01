<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;


class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
            $marcas = Marca::all();
            //compac genera un array con la info que queremos
            return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            //validaciones
            $data = request()->validate([
                'descripcion' => 'required',

            ]) ;
            //creo una nueva marca y loguardo en la B.D


            $marca = new Marca();

            $marca->descripcion = $request->descripcion ;


            $marca->save();
            return redirect(route('marcas.index'))->with('success','Marca guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        //
        $marca->fill($request->all());
        $marca->update();
        return redirect(route('marcas.index'))->with('success','Marca actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        //
        $marca->delete();
        return redirect(route('marcas.index'))->with('success','Marca eliminado con exito!');
    }

    public function storeAjax(Request $request){


        if (request()->ajax()){
            $validator = Validator::make(
                array(
                    'descripcion' => $request->get('descripcion')
                ),
                array(
                    'descripcion' => 'required',
                )
            );

            if ($validator->fails()) {
                return $validator->errors()->all();
            } else {
                $data = [
                    'descripcion' => $request->get('descripcion'),
                
                ];
                $marca = Marca::create($data);
                return ['1', $marca];
            }
        }
    }
}
