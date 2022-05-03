<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use App\Direccion;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los proveedores guardados en la B.D y visualizarlos
        $proveedores = Proveedor::all();
        //compac genera un array con la info que queremos
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
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
            'cuit' => 'required|unique:proveedors',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
            'email' => 'required|email|unique:proveedors',
            'direc_postal' => 'required',
        ]) ;
        //creo un nuevo proveedor y loguardo en la B.D
        $direccion = new Direccion();
        $direccion->calle = $request->calle ;
        $direccion->altura = $request->altura ;

        $direccion->save();

        $proveedor = new Proveedor();

        $proveedor->nombre = $request->nombre ;
        $proveedor->cuit = $request->cuit ;
        $proveedor->telefono = $request->telefono ;
        $proveedor->email = $request->email ;
        $proveedor->direc_postal = $request->direc_postal ;
        $proveedor->direccion_id = $direccion->id;

        $proveedor->save();
        return redirect(route('proveedores.index'))->with('success','proveedor guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $proveedor = proveedor::find($id);

    // return $proveedor;
       return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = proveedor::find($id);

        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor = proveedor::find($id);

        //funcion fill se encarga de actualizar los datos q recibimos
        $proveedor->fill($request->all());
        $proveedor->update();
        return redirect(route('proveedores.index'))->with('success','proveedor actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = proveedor::find($id);
        $proveedor->delete();
        return redirect(route('proveedores.index'))->with('success','proveedor eliminado con exito!');
    }
}
