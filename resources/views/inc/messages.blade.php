@if (count($errors) > 0)
	@foreach ($errors->all() as $error)
		<div class="alert alert-danger text-center">
			{{$error}}
		</div>
	@endforeach
@endif


@if (session('success'))
	<div class="alert alert-success text-center">
		<h3>
			<b>{{session('success')}}</b>
		</h3>
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger text-center">
		<h3>
			<b>{{session('error')}}</b>
		</h3>
	</div>
@endif

@if (session('delete'))
	<div class="alert alert-warning text-center">
		<h3>
			<b>{{session('delete')}}</b>
		</h3>
	</div>
@endif

@if (session('ticket'))
	<div class="alert alert-warning text-center">
		<h3>
			Ticket number is: <b>{{session('ticket')}}</b>
		</h3>
	</div>
@endif