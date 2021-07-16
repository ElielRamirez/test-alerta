@extends('layouts.main')
@section('title')
Medidores
@endsection


@section('content')

<div class="container mt-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#meterModal">
        Nuevo
    </button>
    <button type="button" class="ml-2 btn btn-primary" data-toggle="modal" data-target="#readerModal">
        Lecturas
    </button>
</div>
<main class="container mt-5">
    <table id="meters-table" class="display">
        <thead>
            <tr>
                <th>Medidor</th>
                <th>Descripción</th>
                <th>Versión</th>
                <th>Tipo</th>
                <th>Fecha instalación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfooter>
            <tr>
                <th>Medidor</th>
                <th>Descripción</th>
                <th>Versión</th>
                <th>Tipo</th>
                <th>Fecha instalación</th>
                <th>Acciones</th>
            </tr>
        </tfooter>
    </table>
</main>
<!-- Button trigger new meter modal -->
<div class="modal fade" id="meterModal" tabindex="-1" role="dialog" aria-labelledby="meterModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meterModalLabel">Alta Medidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMeterForm">

                    <div class="form-group row">
                        <label for="num_meter" class="col-sm-3 col-form-label"># Medidor</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="num_meter" id="num_meter"
                                placeholder="# 89967203" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Descripción</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" id="description"
                                placeholder="Describe las cualidades del medidor"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="version" class="col-sm-3 col-form-label">Versión</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="version" id="version" placeholder="1.02.69" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="version" class="col-sm-3 col-form-label">Tipo</label>
                        <div class="col-sm-9">
                            <select name="type" id="type" class="form-control">
                                <option disbled selected>Seleccionar...</option>
                                <option value="mni">MNI</option>
                                <option value="mna">MNA</option>
                                <option value="mnt">MNT</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Button trigger new charge modal -->
<div class="modal fade" id="readerModal" tabindex="-1" role="dialog" aria-labelledby="readerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readerModalLabel">Modulo de Lectura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addReaderForm">

                    <div class="form-group row">
                        <label for="num_meter" class="col-sm-3 col-form-label"># Medidor</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="num_meter" id="num_meter"
                                placeholder="# 89967203" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="loadLevel" class="col-sm-3 col-form-label">Nivel Gas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="load_level" id="loadLevel"
                                placeholder="% gas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="batteryLevel" class="col-sm-3 col-form-label">Nivel Bateria</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="battery_level" id="batteryLevel"
                                placeholder="% bateria">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection


@section('js')

<script>
let trigger = () => {
    $('#edit-meter').on('click', function(e) {
        const meter = $(this).data('meter');
        $.ajax({
            url: `/api/meter/${meter}`,
            type: 'GET',
            success: function(response) {
                console.log(response)
            },
            error: function(xhr, ajaxOptions, thrownError) {
            }

        });
        $('#meterModal').modal('show');
    });
}
$(document).ready(function() {
    $.ajax({
        url: '/api/meter',
        type: 'GET',
        success: function(response) {
            let strFields = '';
            for (const item of response) {
                strFields += `<tr>
                            <td>${item.num_meter}</td>
                            <td>${item.description}</td>
                            <td>${item.version}</td>
                            <td class="text-uppercase">${item.type}</td>
                            <td>${!item.instalation_date? 'Inactivo':item.instalation_date}</td>
                            <td id="edit-meter" data-meter="${item.num_meter}">
                                <a href="javascript:;"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>`;
            }
            $('#meters-table').prepend(strFields);
            $('#meters-table').DataTable();
            trigger();
        },
        error: function(xhr, ajaxOptions, thrownError) {

        }

    });
});
</script>
@endsection