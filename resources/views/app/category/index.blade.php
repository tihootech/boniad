@extends('layouts.dashboard')
@section('title')
    دسته بندی شاخص های ارزیابی
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('category.create')}}" class="btn btn-primary">
			<i class="material-icons">add</i>
			تعریفه دسته بندی جدید
		</a>
	</div>
    <div class="tile">

		@if ($categories->count())

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col"> ردیف </th>
						<th scope="col"> نام دسته بندی </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categories as $index => $category)
						<tr>
							<th scope="row"> {{$index+1}} </th>
							<td> {{$category->name}} </td>
							<td>
								<a href="{{route('category.edit', $category->id)}}"> <i class="material-icons icon">edit</i> </a>
							</td>
							<td>
								<form class="d-inline" action="{{route('category.destroy', $category->id)}}" method="post">
									@csrf
									@method('DELETE')
									<a href="javascript:void" class="delete"> <i class="material-icons icon text-danger">delete</i> </a>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		@else
			@include('includes.nothing_found')
		@endif

    </div>

@endsection