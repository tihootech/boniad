@extends('layouts.dashboard')
@section('title')
    مدیریت شاخص ها
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('indicator.create')}}" class="btn btn-primary">
			<i class="material-icons">add</i>
			تعریفه شاخص جدید
		</a>
	</div>
    <div class="tile">

		@if ($indicators->count())

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col"> ردیف </th>
						<th scope="col"> عنوان شاخص </th>
						<th scope="col"> سقف امتیازات </th>
                        <th scope="col"> دسته بندی </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($indicators as $index => $indicator)
						<tr>
							<th scope="row"> {{$index+1}} </th>
							<td> {{$indicator->title}} </td>
							<td> {{$indicator->points}} </td>
							<td> {{$indicator->category->name ?? '-'}} </td>
							<td>
								<a href="{{route('indicator.edit', $indicator->id)}}"> <i class="material-icons icon">edit</i> </a>
							</td>
							<td>
								<form class="d-inline" action="{{route('indicator.destroy', $indicator->id)}}" method="post">
									@csrf
									@method('DELETE')
									<a href="javascript:void" class="delete"> <i class="material-icons icon text-danger">delete</i> </a>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
            {{$indicators->links()}}
		@else
			@include('includes.nothing_found')
		@endif

    </div>

@endsection
