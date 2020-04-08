@if (session('message'))
	<div class="alert alert-success">
		<i class="fa fa-check ml-1"></i>
		{{session('message')}}
	</div>
@endif
@if (session('error'))
	<div class="alert alert-danger" role="alert">
		{{ session('error') }}
	</div>
@endif
@if (isset($errors) && $errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
