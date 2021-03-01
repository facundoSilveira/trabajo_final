@extends('admin-lte.index')

@section('content')
<div class="card">
    <div class="card-header">pedidos
        <a class="btn btn-primary btn-sm float-right text-white" href="{{route('pedidos.create')}}">Nuevo</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-dark dataTable">
            <thead>
            <tr>

                <th scope="col">Fecha</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Detalle</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td class="text-right">{{ \Carbon\Carbon::create($pedido->fecha)->format('d/m/Y')}}</td>

                         <td>
                            @if ($pedido->proveedor!= null)
                               <span class="badge bg-light"> {{$pedido->proveedor->nombre}}</span>
                            @else
                            <span class="badge bg-danger"> Sin asignar</span>
                            @endif
                        </td>

                    <td class="text-right">

                        @foreach($pedido->detalles as $detalle)
                        {{$detalle->recurso->tipo_recurso->nombre}}
                        @endforeach
                    </td>
                    <td class="text-right">
                        @if ($pedido->confirmado == 1)
                            <span class="badge bg-success">Realizado</span>
                            @else
                            <span class="badge bg-warning">No Realizado</span>
                        @endif</td>

                    <td class="text-right">
                        <a class="btn btn-light btn-sm" href="{{ route('pedidos.edit', $pedido->id) }}">Editar</a>
                        <a class="btn btn-danger btn-sm text-white delete" val-palabra={{$pedido->id}}>Borrar</a>
                        <a class="btn btn-outline-light btn-sm" href="{{ route('pedidos.show', $pedido->id) }}">Ver mas</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="confirmDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmacion</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Esta seguro que desea borrarlo?</h4>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    {{-- Paso el id del pedido a borrar --}}
                    <button type="submit" name="ok_delete" id="ok_delete" class="btn btn-danger">SI Borrar</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">NO Borrar</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

{{-- Script para eliminar --}}
<script>
    $(document).on('click', '.delete', function(){
    id = $(this).attr('val-palabra');

    url2="{{route('pedidos.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
</script>
@endpush
