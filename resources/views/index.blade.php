@extends('layouts.main')

@section('title', 'Registro de medidores')

@section('css')
<style>
.row {
    width: 100%;
}

.form-inline label {
    justify-content: right;
}
</style>
@endsection

@section('content')
<main class="container mt-5 mx-auto">
    <table id="resume-table" class="table display table-striped table-bordered dt-responsive " style="width:100%">
        <thead>
            <tr>
                <th>Medidor</th>
                <th>Descripción</th>
                <th>Bateria%</th>
                <th>Estatus</th>
                <th>Fecha de instalación</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meters as $meter)
            <tr>
                <td>{{$meter->num_meter}}</td>
                <td>{{$meter->description}}</td>
                <td>{{$meter->battery_level}}</td>
                <td>{{$meter->load_date}}</td>
                @if(!$meter->instalation_date)
                <td>---</td>
                @else
                <td>{{$meter->instalation_date}}</td>

                @endif
                <td class="text-uppercase">{{$meter->type}}</td>
                <td>
                    <a class="delete" href="#" data-num-meter="{{$meter->num_meter}}"><i class="fas fa-trash"></i></a>
                    <a href="#"><i class="fas fa-search"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Medidor</th>
                <th>Descripción</th>
                <th>Bateria%</th>
                <th>Estatus</th>
                <th>Fecha de instalación</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
</main>

@endsection
@section('js')

<script>
$(document).ready(function() {
    $('#resume-table').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

    });
});
</script>
@endsection