<?php

namespace App\Http\Controllers;

use App\InformeServicio;
use App\InformeServicioRecurso;
use App\Recurso;
use App\Servicio;
use Illuminate\Http\Request;
use Exception;
use stdClass;

class InformeServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Aca voy a obtener todos los informes guardados en la B.D y visualizarlos
         $informes = InformeServicio::all();
         //compac genera un array con la info que queremos
         return view('informes.index', compact('informes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      //  $accesorios = Accesorio::all();
      //  $tecnicos= Tecnico::all();
          $recursos = Recurso::all();

        return view('informes.create', compact('recursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // return $request;
            //validaciones
            $data = request()->validate([
                'presupuesto' => 'required',
                'fechaInicio' => 'required',
                'fechaFin' => 'required',
                'problemaTecnico' => 'required',
                'descripcion' => 'required',
                'cantidad.*' => 'required',
                'recurso.*' => 'required'
            ]) ;
            //creo un nuevo informe y loguardo en la B.D


            $sinStock = collect() ;
            for ($i=0; $i < sizeof($request->recurso); $i++) {
                $recursoOb = Recurso::find($request->recurso[$i]) ;
                if($recursoOb->obtenerStock() < $request->cantidad[$i]){
                    $sinStock->add($recursoOb) ;
                }
            }



            $informe = new InformeServicio();

            $informe->presupuesto = $request->presupuesto;
            $informe->fechaInicio = $request->fechaInicio ;
            $informe->fechaFin = $request->fechaFin ;
            $informe->problemaTecnico = $request->problemaTecnico;
            $informe->descripcion = $request->descripcion;
            $informe->servicio_id = $request->servicio_id;
            $servicio = Servicio::find($request->servicio_id);
            $informe->tecnico_id = $servicio->tecnico->id;

            $informe->save();
           // return $servicio->id;



        //return $request;

            for ( $i = 0; $i < sizeof( $request->cantidad ); $i++){
                // $recurso = Recurso::find($request->recurso[$i]);
                // return $recurso->precio;
                $informeRecurso = new InformeServicioRecurso();
                $informeRecurso->cantidad = $request->cantidad[$i] ;
                $informeRecurso->recurso_id = $request->recurso[$i] ;

                $informeRecurso->informe_servicio_id = $informe->id;
                if(sizeof($sinStock) > 0){
                    $informeRecurso->reserva = false;
                    //aca se va a realizr el pedido
                }else{
                    $informeRecurso->reserva = true;
                }

               // $recurso = Recurso::find($request->recurso[$i]);
               // return $recurso;
               // $recurso->stock = $recurso->stock + $request->cantidad[$i];
               //return $request->recurso[$i];
               $informeRecurso->save();




            //return redirect()->back();
            }


        /*$input = $request->all();
        $proyectoAmbiente = $this->proyectoAmbienteRepository->create($input);
        $proyectoAmbiente->Proyecto_id = $proyecto->id;
        $proyectoAmbiente->save();*/



        //return ($proyecto);

          //  return $request->cantidad;

           // $incidencia->tipo_incidencia_id = $request->tipo_incidencia_id;
            // $informe->save();
            // $data = [
            //     1 => ['recurso_id' => $request->input('recurso')],
            //     2 => ['cantidad' => $request->input('cantidad')]
            // ];
            // $informe->informeRecurso()->sync($data);
            //return ["recurso_id" => $request->recurso, "cantidad" => $request->cantidad, "informe_servicio_id" => $informe->id];
            //implementar en la vista servicio
            //$informe->accesorios()->sync($request->accesorios_id);
            //crear qr

             $data = new stdClass();
             $data = request();
            // $data->sinStock = $sinStock;
            // $data->recursos = $request->recurso;
            // $data->problema = $request->problemaTecnico;
            //return $data;
            $servicio->equipo->cliente->enviarMail($data);
           // return $servicio->informe->presupuesto;
            return redirect()->route('servicios.atender_servicio', $servicio);
            //return $servicio->atender_servicio($servicio->id, $request);
           // return redirect(route('servicios.atender_servicio', ['servicio' => $servicio->id]))->with('success','informe enviado con exito!');
           // return $sinStock;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InformeServicio  $informeServicio
     * @return \Illuminate\Http\Response
     */
    public function show(InformeServicio $informeServicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InformeServicio  $informeServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(InformeServicio $informe)
    {
        return view('informes.edit', compact('informe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InformeServicio  $informeServicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformeServicio $informe)
    {
        $informe->fill($request->all());
        $informe->update();
        return redirect(route('informes.index'))->with('success','informe actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InformeServicio  $informeServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformeServicio $informe)
    {
        $informe->delete();
        return redirect(route('informes.index'))->with('success','informe eliminado con exito!');
    }

    public function getServicio($id){
        $recursos = Recurso::all();

        return view('informes.create', compact('recursos', 'id'));
    }
}
