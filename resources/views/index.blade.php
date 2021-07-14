<!doctype html>
<html lang="en">
  <head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
	<title>Resumen de medición</title>
	
  </head>
  <body>
	
  	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
							Medidores
						</a>
						<div class="dropdown-menu px-2">
							<button type="button" class="nav-link dropdown-item btn btn-primary" data-toggle="modal" data-target="#meterModal">
								Nuevo
							</button>
							<button type="button" class="nav-link dropdown-item btn btn-primary" data-toggle="modal" data-target="#readerModal">
								Lecturas
							</button>
						</div>
						
					</li>
					
				</ul>
			</div>
		</div>
	</nav>           
		
	<main class="container">
		<div class="row">
			<table id="meters-table" class="table table-striped" style="width:100%">
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
						@if(!$meter->instalation_date)
						<td>---</td>
						@endif
						<td>{{$meter->instalation_date}}</td>
						<td>{{$meter->type}}</td>
						<td><button>Eliminar</button><button>Buscar</button></td>
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
		</div>
	</main>
{{$meters}}
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="{{ asset('/js/app.js') }}"></script>
	<script src="{{ asset('/js/meter.js') }}"></script>
	<script src="{{ asset('/js/reader.js') }}"></script>
  </body>
</html>