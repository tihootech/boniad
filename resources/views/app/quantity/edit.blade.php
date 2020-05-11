@extends('layouts.dashboard')
@section('title')
    مدیریت هدف کمی : بنیاد {{$branch->name}}
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('branch.index')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به لیست بنیاد ها
		</a>
	</div>
	<form action="{{route('quantity.update', $branch->id)}}" method="post">
		@csrf
		@method('PUT')

		<div class="tile">
			<h4 class="text-center text-primary mb-3"> الگوی مصرف </h4>
			<div class="row">
				@foreach ($resources as $resource)
					<div class="col-lg-3 col-md-4 form-group align-self-end">
						<p> {{$resource->name}} ({{$resource->unit}}) </p>
						<input type="number" min="1" class="form-control" name="resources[{{$resource->id}}]" required
							value="{{$resource->quantity_target($branch->id)}}">
					</div>
				@endforeach
			</div>
		</div>

		<div class="tile">
			@foreach ($categories as $i => $category)
				@if ($i)
					<hr>
				@endif
				<h4 class="text-center text-primary mb-5"> {{$category->name}} </h4>
				<div class="row">
					@foreach ($category->indicators as $index => $indicator)
						<div class="col-lg-4 col-md-6 form-group align-self-end">
							<p> {{$index+1}}. {{$indicator->title}} </p>
							<input type="number" min="1" class="form-control" name="indicators[{{$indicator->id}}]" required
								value="{{$indicator->quantity_target($branch->id)}}">
						</div>
					@endforeach
				</div>
			@endforeach
		</div>


		<div class="tile text-center">
			<button type="submit" class="btn btn-primary">
				<i class="material-icons">check</i>
				تایید
			</button>
		</div>

	</form>

@endsection
