<!doctype html>
<html lang="en">
  <head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	@yield('css')
	<title>@yield('title')</title>
	
  </head>
  <body>
	
  	<nav class="navbar navbar-expand-lg navbar-light shadow" >
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
							<a href="/meters" class="nav-link dropdown-item btn btn-primary" >
								Stock
							</a>
						</div>
						
					</li>
					
				</ul>
			</div>
		</div>
	</nav>           
		
	@yield('content')
	<script src="{{ asset('/js/app.js') }}"></script>
	@yield('js')
	<script src="{{ asset('/js/meter.js') }}"></script>
	<script src="{{ asset('/js/reader.js') }}"></script>
	
  </body>
</html>