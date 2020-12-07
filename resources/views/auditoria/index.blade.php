@extends('admin-lte.index')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Auditoria
            <button type="submit" class="btn btn-xs btn-danger ">Generar <i class="fa fa-file-pdf"></i></button>
        </h3>
        @csrf
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive table-bordered table-sm">
            <table id="auditorias" class="table table-bordered table-striped table-hover dataTable">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Tabla</th>
                        <th>Operacion</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Usuario</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auditoriasEquipo as $auditoria)
                    <tr>
                        <td>{{$auditoria->auditable_id}}</td>
                        <td>EQUIPOS</td>
                        <td style="text-transform:uppercase">{{$auditoria->event}}</td>
                        <td class="text-right">{{$auditoria->created_at->format('d/m/Y')}}</td>
                        <td class="text-right">{{$auditoria->created_at->format('H:i:s')}}</td>
                        {{-- <td>{{$auditoria->user->apellido}} {{$auditoria->user->name}}</td> --}}
                        <td></td>
                        <td width="150px" class="text-center">
                            <a href="{{ route('auditoria.showEquipos', ['auditoria' => $auditoria->auditable_id, 'id' => $auditoria->id])}}"
                                class="btn btn-xs btn-primary">Ver
                                mas</a>

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

