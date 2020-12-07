@extends('admin-lte.index')

@section('content')
<div class="card">
    <div class="card-header">Accesorios
        <a class="btn btn-primary btn-sm float-right text-white" href="{{route('accesorios.create')}}">Nuevo</a>
    </div>

<div class="card-body">
    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descripcion</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($accesorios as $accesorio)
            <tr>
                <td>{{$accesorio->id}}</td>
                <td>{{$accesorio->descripcion}}</td>

                <td class="text-right">
                    <a class="btn btn-light btn-sm" href="{{ route('accesorios.edit', $accesorio->id) }}">Editar</a>
                    <a class="btn btn-danger btn-sm text-white delete" val-palabra={{$accesorio->id}}>Borrar</a>
                    <a class="btn btn-outline-light" href="{{ route('accesorios.show', $accesorio->id) }}">Ver mas</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                    {{-- Paso el id del cliente a borrar --}}
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

    url2="{{route('accesorios.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
</script>
@endpush

