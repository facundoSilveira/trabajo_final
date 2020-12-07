<?php

namespace App\Http\Controllers;

use App\MarcaRecurso;
use App\Medida;
use App\Modelo;
use App\Recurso;
use App\TipoRecurso;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Aca voy a obtener todos los equipos guardados en la B.D y visualizarlos
         $recursos = Recurso::all();
         //compac genera un array con la info que queremos
         return view('recursos.index', compact('recursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medidas = Medida::all();
        $marca_recursos = MarcaRecurso::all();
        $tipo_recursos = TipoRecurso::all();
        $modelos = Modelo::all();
      //  $tecnicos= Tecnico::all();
        return view('recursos.create', compact('medidas','tipo_recursos','marca_recursos','modelos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'nroSerie' => 'required|unique:recursos',
            'modelo_id' => 'required',
            'tipo_recurso_id.*' => 'required',
            'marca_recurso_id' => 'required',
            'medida_id' => 'required',
            'modelo_id' => 'required',
            'tamaño' => 'required',
            'stockMinimo' => 'required',


        ]) ;
         $sql = 'SELECT * FROM recursos';
         $recursos = DB::select($sql);
       //  $recursos = DB::table('recursos')->where('modelo',$request->modelo)->first();
       // return Recurso::where('tamaño', $request->tamaño)->first();
         if ((Recurso::where('tamaño', $request->tamaño)->first()) &&  (Recurso::where('modelo_id', $request->modelo_id)->first())){
            return redirect()->back()->with('error','este recurso ya a sido registrado');
         }

        //creo un nuevo recurso y loguardo en la B.D

        $recurso = new Recurso();

        $recurso->stockMinimo = $request->stockMinimo;
        $recurso->nroSerie = $request->nroSerie ;
        $recurso->tamaño = $request->tamaño ;
        //$recurso->precio = $request->precio ;
        $recurso->medida_id = $request->medida_id;
        $recurso->modelo_id = $request->modelo_id;
        $recurso->marca_recurso_id = $request->marca_recurso_id;
        $recurso->tipo_recurso_id = $request->tipo_recurso_id;


       // $incidencia->tipo_incidencia_id = $request->tipo_incidencia_id;
        $recurso->save();
        //return 'Yes';
        return redirect(route('recursos.index'))->with('success','recurso guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recurso $recurso)
    {
        return view('recursos.show', compact('recurso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function edit(Recurso $recurso)
    {
        return view('recursos.edit', compact('recurso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recurso $recurso)
    {

            //funcion fill se encarga de actualizar los datos q recibimos

            $recurso->update();
            return redirect(route('recursos.index'))->with('success','recurso actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recurso $recurso)
    {
        $recurso->delete();
        return redirect(route('recursos.index'))->with('success','recurso eliminado con exito!');
    }
}
