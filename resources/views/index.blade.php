@extends('layouts.main')

@section('title', 'Registro de medidores')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
<style>
	.row{
		width:100%;
	}
	.form-inline label {
    justify-content: right;
}
</style>
@endsection

@section('content')
	<main class="container mt-5 mx-auto">
			<table id="meters-table" class="table display table-striped table-bordered dt-responsive " style="width:100%" >
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
   <!-- Button trigger new meter modal -->
	<div class="modal fade" id="meterModal" tabindex="-1" role="dialog" aria-labelledby="meterModalLabel" aria-hidden="true">
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
							<input type="text" class="form-control" name="num_meter" id="num_meter" placeholder="# 89967203" />
						</div>
					</div>
					<div class="form-group row">
						<label for="description" class="col-sm-3 col-form-label">Descripción</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="description" id="description" placeholder="Describe las cualidades del medidor" ></textarea>
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
	 <div class="modal fade" id="readerModal" tabindex="-1" role="dialog" aria-labelledby="readerModalLabel" aria-hidden="true">
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
							<input type="text" class="form-control" name="num_meter" id="num_meter" placeholder="# 89967203" />
						</div>
					</div>
					<div class="form-group row">
						<label for="loadLevel" class="col-sm-3 col-form-label">Nivel Gas</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="load_level" id="loadLevel" placeholder="% gas" >
						</div>
					</div><div class="form-group row">
						<label for="batteryLevel" class="col-sm-3 col-form-label">Nivel Bateria</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="battery_level" id="batteryLevel" placeholder="% bateria" >
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
<script src='https://code.jquery.com/jquery-3.5.1.js'></script> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script> 
<script src='https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js'> </script>                   
<script src='https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js'></script>
<script>
	$(document).ready(function() {
		$('#meters-table').DataTable();
	} );
</script>
@endsection