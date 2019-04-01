@extends('app')

@section('content')

<h3 class="text-center mt-5 mb-3">ACCIÓN</h1>
<div id="accion" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" id="accion1">
		{{-- <div class="carousel-item active">
			<div class="container">
				<div class="row justify-content-md-center">										
					<div class="card" style="width: 50%;">
						<img src="img/a.jpg" class="d-block w-100" alt="...">
						<div class="card-body">
							<h5 class="card-title">Avengers</h5>
							<p class="card-text">Matar al hp de thanos</p>
							<a href="#" class="btn btn-primary">Reservar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="carousel-item">
			<a href="">b</a>

		</div>
		<div class="carousel-item">
			<a href="">c</a>

		</div> --}}
	</div>
	<a class="carousel-control-prev" href="#accion" role="button" data-slide="prev">
		<i class="fas fa-backward" style="color: black; font-size: 40px;"></i>		
	</a>
	<a class="carousel-control-next" href="#accion" role="button" data-slide="next">
		<i class="fas fa-forward" style="color: black; font-size: 40px;"></i>		
	</a>
</div>



@endsection