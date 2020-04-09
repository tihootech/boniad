@extends('layouts.dashboard')
@section('title')
    مدیریت شعب
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('branch.create')}}" class="btn btn-primary">
			<i class="material-icons">add</i>
			تعریفه شعبه جدید
		</a>
	</div>
    <div class="tile">

		@if ($branches->count())

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col"> ردیف </th>
						<th scope="col"> نام شعبه </th>
						<th scope="col"> نام کاربری جهت ورود به سیستم </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($branches as $index => $branch)
						<tr>
							<th scope="row"> {{$index+1}} </th>
							<td> {{$branch->name}} </td>
							<td> {{$branch->user->name ?? 'Database Error'}} </td>
							<td>
								<a href="{{route('branch.edit', $branch->id)}}"> <i class="material-icons icon">edit</i> </a>
							</td>
							<td>
								<form class="d-inline" action="{{route('branch.destroy', $branch->id)}}" method="post">
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
