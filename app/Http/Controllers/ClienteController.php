<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Direccion;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los clientes guardados en la B.D y visualizarlos
        $clientes = Cliente::all();
        //compac genera un array con la info que queremos
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
            'apellido' => 'required',
            'dni' => 'required|unique:clientes',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
            'email' => 'required|email|unique:clientes',
        ]) ;
        //creo un nuevo cliente y loguardo en la B.D
        $direccion = new Direccion();
        $direccion->calle = $request->calle ;
        $direccion->altura = $request->altura ;

        $direccion->save();

        $cliente = new Cliente();

        $cliente->nombre = $request->nombre ;
        $cliente->apellido = $request->apellido ;
        $cliente->dni = $request->dni ;
        $cliente->telefono = $request->telefono ;
        $cliente->email = $request->email ;
        $cliente->direccion_id = $direccion->id;

        $cliente->save();
        return redirect(route('clientes.index'))->with('success','Cliente guardado con exito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
       // $cliente = Cliente::find($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //funcion fill se encarga de actualizar los datos q recibimos
        $cliente->fill($request->all());
        $cliente->update();
        return redirect(route('clientes.index'))->with('success','Cliente actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
        $cliente->delete();
        return redirect(route('clientes.index'))->with('success','Cliente eliminado con exito!');
    }
}
