@extends('layouts.dashboard')
@section('title')
    گزارش مصرف
@endsection
@section('content')

    <div class="tile text-md-left text-center">
        @master
            <a href="{{route('green_management')}}" class="btn btn-primary">
                <i class="material-icons">arrow_forward</i>
                بازگشت به بخش مدیریت سبز
            </a>
        @else
            <a href="{{route('consumption.create')}}" class="btn btn-primary">
                <i class="material-icons">add</i>
                گزارش مصرف جدید
            </a>
        @endmaster
    </div>
    <div class="tile">
        @master
            <h4> لیست کامل گزارش مصرف </h4>
        @else
            <h4> لیست گزارشات قبلی </h4>
        @endmaster
        <hr>

		@if ($consumptions->count())

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col"> ردیف </th>
                        @master
                            <th scope="col"> شعبه </th>
                        @endmaster
						<th scope="col"> منبع </th>
						<th scope="col"> مقدار مصرف </th>
                        <th scope="col"> سال </th>
                        <th scope="col"> ماه </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($consumptions as $index => $consumption)
						<tr>
							<th scope="row"> {{$index+1}} </th>
                            @master
                                <td> {{$consumption->branch->name ?? '-'}} </td>
                            @endmaster
                            <td> {{$consumption->resource->name ?? '-'}} </td>
							<td class="calibri"> {{$consumption->amount}} </td>
							<td> {{$consumption->year}} </td>
							<td> {{persian_month_names($consumption->month)}} </td>
							<td>
								<a href="{{route('consumption.edit', $consumption->id)}}"> <i class="material-icons icon">edit</i> </a>
							</td>
							<td>
								<form class="d-inline" action="{{route('consumption.destroy', $consumption->id)}}" method="post">
									@csrf
									@method('DELETE')
									<a href="javascript:void" class="delete"> <i class="material-icons icon text-danger">delete</i> </a>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
            {{$consumptions->links()}}
		@else
			@include('includes.nothing_found')
		@endif

    </div>

@endsection
