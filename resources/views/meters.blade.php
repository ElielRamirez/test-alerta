<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Stock de Medidores</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow" >
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link">
                            Medidores
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  
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
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        let trigger = ()=>{
            $('#edit-meter').on('click',function(e){
                const meter = $(this).data('meter');
                $.ajax({
                url: `/api/meter/${meter}`,
                type: 'GET',
                success: function(response){
                    console.log(response)
                    
                    
                },
                error:function(xhr, ajaxOptions, thrownError){
                    
                }

            });
            $('#meterModal').modal('show');
            });
        }
        $(document).ready( function () {
            $.ajax({
                url: '/api/meter',
                type: 'GET',
                success: function(response){
                    let strFields = '';
                    for(const item of response){
                        strFields += `<tr>
                            <td>${item.num_meter}</td>
                            <td>${item.description}</td>
                            <td>${item.version}</td>
                            <td class="text-uppercase">${item.type}</td>
                            <td>${item.instalation_date}</td>
                            <td id="edit-meter" data-meter="${item.num_meter}">
                                <i class="fas fa-edit"></i>
                            </td>
                        </tr>`;
                    }
                    $('#meters-table').prepend(strFields);
                    $('#meters-table').DataTable();
                    trigger();
                },
                error:function(xhr, ajaxOptions, thrownError){
                    
                }

            });
        } );
    </script>
</body>
</html>