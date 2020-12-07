@extends('admin-lte.index')

@section('content')
<div class="card">
    <div class="card-header">Movimientos
        <a class="btn btn-primary btn-sm float-right text-white" href="{{route('movimientos.create')}}">Nuevo</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-dark dataTable">
            <thead>
            <tr>
                <th scope="col">Tipo de movimiento</th>
                <th scope="col">Recurso</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">fecha</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($movimientos as $movimiento)
                <tr>
                    <td>{{$movimiento->tipoMovimiento->nombre}}</td>
                    <td>{{$movimiento->recurso->tipo_recurso->nombre}} {{$movimiento->recurso->tamaño}} {{$movimiento->recurso->medida->nombre}}</td>
                    <td>{{$movimiento->cantidad}}</td>
                    <td class="text-right">{{$movimiento->precio}}</td>
                    <td>{{$movimiento->cabeceraMovimiento->fecha}}</td>
                    <td class="text-right">
                        <a class="btn btn-light btn-sm" href="{{ route('movimientos.edit', $movimiento->id) }}">Editar</a>
                        <a class="btn btn-danger btn-sm text-white delete" val-palabra={{$movimiento->id}}>Borrar</a>
                        <a class="btn btn-outline-light btn-sm" href="{{ route('movimientos.show', $movimiento->id) }}">Ver mas</a>

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
                    {{-- Paso el id del movimiento a borrar --}}
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

    url2="{{route('movimientos.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
</script>
@endpush
