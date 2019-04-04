@extends('app')
@section('content')
	<div class="content">
		<h1>Compra de Prueba</h1>
		<h3>$ 7.000</h3>

		<form action="{{ route('pago') }}" method="POST">
			{{ csrf_field() }}
			<script
			src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			data-key="{{ config('services.stripe.key') }}"
			data-name="Compra"
			data-description="Boleta cine"
			data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
			data-locale="auto">
		  </script>
	</form>
	</div>
@endsection
