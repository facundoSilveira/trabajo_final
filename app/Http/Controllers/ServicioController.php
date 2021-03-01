<?php

namespace App\Http\Controllers;

use App\Prioridad;
use App\Servicio;
use App\TipoServicio;
use App\Estado;
use App\Equipo;
use App\Accesorio;
use App\HistorialEstado;
use App\InformeServicio;
use App\InformeServicioRecurso;
use App\RecursoUtilizado;
use App\Tecnico;
use App\Configuracion;
use App\ServicioTipoServicio;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;


class ServicioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Aca voy a obtener todos los servicios guardados en la B.D y visualizarlos
         $servicios = Servicio::all();
         $tecnicos = Tecnico::all();
         $estados = Estado::all();
         $configuracion = Configuracion::first();
         //compac genera un array con la info que queremos
         return view('servicios.index', compact('servicios', 'tecnicos', 'estados', 'configuracion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_servicios= TipoServicio::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $equipos = Equipo::all();
        $accesorios = Accesorio::all();
        $tecnicos = Tecnico::all();
      //  $tecnicos= Tecnico::all();
        return view('servicios.create', compact('tipo_servicios','prioridades','estados','equipos', 'accesorios', 'tecnicos'));
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
                'fechaRecibida' => 'required',
                'problemaCliente' => 'required',
                'contraseña' => 'required',
                'prioridad_id' => 'required',
                'tipo_servicio_id' => 'required',
                //'marca_id' => 'required',
            ]) ;
            //creo un nuevo servicio y loguardo en la B.D

            $servicio = new Servicio();
            $servicio->fechaRecibida = $request->fechaRecibida ;
            $servicio->problemaCliente = $request->problemaCliente ;
            $servicio->contraseña = $request->contraseña ;
            $servicio->prioridad_id = $request->prioridad_id;
           // $servicio->tipo_servicio_id = $request->tipo_servicio_id;
            $servicio->equipo_id = $request->equipo_id;
            $servicio->tecnico_id = $request->tecnico_id;

            //return $servicio->tipo_servicio->id;
           // $incidencia->tipo_incidencia_id = $request->tipo_incidencia_id;
          // return $request;
            $servicio->save();
            $servicio->accesorios()->sync($request->accesorios_id);
            for ( $i = 0; $i < sizeof( $request->tipo_servicio_id ); $i++){
                // $recurso = Recurso::find($request->recurso[$i]);
                // return $recurso->precio;
                $tipoServicio = new ServicioTipoServicio();

                $tipoServicio->servicio_id = $servicio->id;

                $tipoServicio->tipo_servicio_id= $request->tipo_servicio_id[$i];
                $tipoServicio->save();
            }
            $historial = new HistorialEstado();
            $historial->servicio_id = $servicio->id;
          //  return $historial->estado->id[1]->nombre;
            $historial->estado_id = Estado::first()->id ;
            $historial->date = Carbon::now();
            $historial-> save();

            // return $servicio->accesorios->nombre;
          //  $servicio->historiales()->sync($request->estados_id);
            //crear qr

            return redirect(route('servicios.index'))->with('success','servicio guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        $tecnicos = Tecnico::all();
        return view('servicios.show', compact('servicio', 'tecnicos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function agregar_tecnico(Servicio $servicio, Request $request)
    {
        $servicio->tecnico_id = $request->tecnico_id;
        $servicio->save();
        return redirect()->back();
    }
    public function update(Request $request, Servicio $servicio)
    {
        $servicio->fill($request->all());
        $servicio->update();
        return redirect(route('servicios.index'))->with('success','servicio actualizado con exito!');
    }

    public function mis_servicios(Servicio $servicio)
    {

        // $id = Auth::id();
        $user = Auth::user();

        // $user = User::find(['id'=>$id]);
        // return $user->roles();
        if ($user->roles->first()->slug == 'ADMIN'){
            $servicios = Servicio::all();
        }else{
            $servicios = Servicio::where('tecnico_id',$user->tecnico->id)->orderBy('fechaRecibida', 'asc')->get();
            for ($i = 1; $i < count($servicios); $i++) {
                for ($j = 0; $j < count($servicios) - $i; $j++) {
                    if ($servicios[$j]->prioridad->id > $servicios[$j + 1]->prioridad->id) {
                        $k = $servicios[$j + 1];
                        $servicios[$j + 1] = $servicios[$j];
                        $servicios[$j] = $k;
                    }
                }
            }
        }
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $configuracion = Configuracion::first();

      //  return $prioridades;
        return view('mis_servicios.index', compact('servicios', 'prioridades', 'estados', 'configuracion'));
    }
    public function servicios_pendientes(Servicio $servicio)
    {
        // $id = Auth::id();
      //  $user = Auth::user();

        // $user = User::find(['id'=>$id]);
        // return $user->roles();

        $servicios = Servicio::where('tecnico_id',null)->get();
       // return $servicios;
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $configuracion = Configuracion::first();
      //  return $prioridades;
        return view('mis_servicios.sin_asignar', compact('servicios', 'prioridades', 'estados', 'configuracion'));
    }
    public function finalizar_servicio(Servicio $servicio)
    {
        for ($i=0; $i < sizeof ($servicio->informe->informeRecurso) ; $i++) {
            $recurUtilizado = New RecursoUtilizado();
            $recurUtilizado->servicio_id = $servicio->id;
            $recurUtilizado->recurso_id = $servicio->informe->informeRecurso[$i]->recurso_id;
            $recurUtilizado->cantidad = $servicio->informe->informeRecurso[$i]->cantidad;
            $recurUtilizado->save();

            $recurso = $recurUtilizado->recurso;
            $recurso->stock = $recurso->stock - $recurUtilizado->cantidad;
            $recurso->update();


            $informeServicio = $servicio->informe->informeRecurso[$i];
            $informeServicio->reserva = null;
            $informeServicio->update();

        }

        return redirect()->route('servicios.atender_servicio', $servicio);
    }


    public function atender_respuesta($valor, InformeServicio $informe)
    {
        //return $informe;
        if($valor ==true){
            $informe->confirmacion == true;
            $estado = $informe->servicio->historiales->last()->estado->id;
            $historial = new HistorialEstado();
            $historial->servicio_id = $informe->servicio->id;
            $historial->estado_id = $estado + 1;
            $historial->date = Carbon::now();
            $historial-> save();
            $informe->update();
            return redirect()->route('mis_servicios.index', $informe->servicio)->with('success','Se cambio al estado CONFIRMADO');


        }else{
            $informe->confirmacion == false;
            //porner en false el recurso
            //return $informe->informeRecurso;
            for ($i=0; $i < sizeof( $informe->informeRecurso ) ; $i++) {
                $informeRecurso = $informe->informeRecurso[$i]->id;
                $informeRecurso = InformeServicioRecurso::find($informeRecurso);
                $informeRecurso->reserva = null;
                $informeRecurso->update();

            }

          //  return $informeRecurso;
            //print $informe->informeRecurso->reserva;
            $estados = Estado::all();
            $estado = $estados->get(sizeof($estados)-2) ;
            $historial = new HistorialEstado();
            $historial->servicio_id = $informe->servicio->id;
            $historial->estado_id = $estado->id;
            $historial->date = Carbon::now();
            $historial-> save();
            $informe->update();
            return redirect()->route('mis_servicios.index', $informe->servicio)->with('success','Se cambio al estado CANCELADO y se libera el recurso resevado');


        }

    }

    public function enviar_informe(InformeServicio $informe)
    {
        return view('respuesta.prueba', compact('informe'));
    }

    public function enviar_informe2(InformeServicio $informe)
    {
        return view('respuesta.prueba2', compact('informe'));
    }

    // public function ver_respuesta(InformeServicio $informe, Servicio $servicio)
    // {
    //     return $informe->confirmacion;
    //     if ($informe->confirmacion == true){
    //         $estado = $servicio->historiales->last()->estado->id;
    //         $historial = new HistorialEstado();
    //         $historial->servicio_id = $servicio->id;
    //         $historial->estado_id = $estado + 1;
    //         $historial->date = Carbon::now();
    //         $historial-> save();
    //     }else{
    //         $estado = Estado::last()->id;
    //         $historial = new HistorialEstado();
    //         $historial->servicio_id = $servicio->id;
    //         $historial->estado_id = $estado;
    //         $historial->date = Carbon::now();
    //         $historial-> save();
    //     }
    //     return redirect()->route('mis_servicios.index', $servicio);
    // }
    public function entregar_servicio(Servicio $servicio, Request $request){
        $estados = Estado::all();
        $estado = $estados->get(sizeof($estados)-1) ;
        $historial = new HistorialEstado();
        $historial->servicio_id = $servicio->id;
        $historial->estado_id = $estado->id;
        $historial->date = Carbon::now();
        $historial-> save();
        //$informe->update();
        return redirect()->route('mis_servicios.index', $servicio)->with('success','Se cambio al estado ENTREGADO y se entrega el equpo al cliente');
    }

    public function atender_servicio(Servicio $servicio, Request $request){
        $estado = $servicio->historiales->last()->estado->id;
        $historial = new HistorialEstado();
        $historial->servicio_id = $servicio->id;
        $historial->estado_id = $estado + 1;
        $historial->date = Carbon::now();
        $historial-> save();

        return redirect()->route('mis_servicios.index', $servicio)->with('success','Se cambio al estado del servicio del cliente '.$servicio->equipo->cliente->nombre.' '.$servicio->equipo->cliente->apellido);
    }
    public function ver_servicio(Servicio $servicio)
    {
        switch ($servicio->getEstado()) {
            case 'Pendiente':
                return view('mis_servicios.pendiente',  compact('servicio'))->with('success','El servicio se ha iniciado, y se cambio al estado EN REVISION');
                break;

            case 'En Revision':
                return view('mis_servicios.revision', compact('servicio'))->with('success','Se cambio al estado EN ESPERA y se envio el informe al cliente');
            break;

            case 'En Espera':
                return view('mis_servicios.espera', compact('servicio'))->with('success','Se cambio al estado EN ESPERA y se envio el informe al cliente');
                break;
            case 'Confirmado':
                return view('mis_servicios.confirmado', compact('servicio'))->with('success','Se cambio al estado CONFIRMADO');
                    break;
            case 'Cancelado':
                return view('mis_servicios.cancelado', compact('servicio'))->with('success','Se cambio al estado EN ESPERA y se envio el informe al cliente');
                break;
            case 'En Proceso':
                return view('mis_servicios.proceso', compact('servicio'))->with('success','Se cambio al estado FINALIZADO y se espera por el retiro del cliente');
                break;
            case 'Finalizado':
                return view('mis_servicios.finalizado', compact('servicio'))->with('success','Se cambio al estado EN ESPERA y se envio el informe al cliente');
                break;
            case 'Entregado':
                return view('mis_servicios.entregado', compact('servicio'));
                    break;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect(route('servicios.index'))->with('success','servicio eliminado con exito!');
    }
}
