<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Equipo;
use App\Servicio;
use App\TipoEquipo;
use App\Marca;
use App\Cliente;
use App\HistorialEstado;
use Exception;


use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Aca voy a obtener todos los equipos guardados en la B.D y visualizarlos
        $equipos = Equipo::all();
        //compac genera un array con la info que queremos
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $marcas = Marca::all();
        $tipo_equipos = TipoEquipo::all();
      //  $accesorios = Accesorio::all();
      //  $tecnicos= Tecnico::all();
        return view('equipos.create', compact('clientes','tipo_equipos','marcas'));
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
                'foto' => 'required',
                'nroSerie' => 'required|unique:equipos',
                'cliente_id' => 'required',
                'tipo_equipo_id' => 'required',
                'marca_id' => 'required',
            ]) ;
            //creo un nuevo equipo y loguardo en la B.D

            if($request->hasFile('foto')){
                $file = $request->file('foto');
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);

            }


            $equipo = new Equipo();

            $equipo->foto = $request->foto;
            $equipo->nroSerie = $request->nroSerie ;
            $equipo->detallesGenerales = $request->detallesGenerales ;
            $equipo->marca_id = $request->marca_id;
            $equipo->cliente_id = $request->cliente_id;
            $equipo->tipo_equipo_id = $request->tipo_equipo_id;
            $equipo->foto = $name;

           // $incidencia->tipo_incidencia_id = $request->tipo_incidencia_id;
            $equipo->save();
            //implementar en la vista servicio
            //$equipo->accesorios()->sync($request->accesorios_id);
            //crear qr

            return redirect(route('equipos.index'))->with('success','Equipo guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        //
        return view('equipos.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        //
        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)

    {
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);

        }
            //funcion fill se encarga de actualizar los datos q recibimos
            $equipo->fill($request->all());
            $equipo->foto = $name;
            $equipo->update();
            return redirect(route('equipos.index'))->with('success','Equipo actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        //
        try {
            $servicios = Servicio::all();
            foreach ($servicios as $servicio) {

                    if ($servicio->equipo_id == $equipo->id ){
                        $historials = HistorialEstado::all();
                        foreach ($historials as $historial) {
                            if ($historial->servicio_id == $servicio->id){
                                if ($historial->estado_id == 8){
                                    $equipo->delete();

                                    return redirect(route('equipos.index'))->with('success','equipo eliminado con exito!');
                                }else{
                                    return redirect(route('equipos.index'))->with('error','no es posible eliminar el equipo ya que cuenta con servicios registrados y aun no fue entregado');
                                }
                            }
                        }

                    }
                }

        } catch (Exception $e) {
            return redirect(route('equipos.index'))->with('error', 'no es posible eliminar el equipo ya que cuenta con servicios registrados');

        }
        // $equipo->delete();
        // return redirect(route('equipos.index'))->with('success','Equipo eliminado con exito!');
    }
}
