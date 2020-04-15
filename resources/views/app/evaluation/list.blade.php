@extends('layouts.dashboard')
@section('title')
    لیست ارزیابی های قبلی
@endsection
@section('content')
    <div class="tile text-md-left text-center">
		<a href="{{route('eval.landing')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به بخش ارزیابی
		</a>
	</div>
    <div class="tile">

		@if ($evaluations->count())

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col"> ردیف </th>
                        @master
                            <th scope="col"> شعبه </th>
                        @endmaster
						<th scope="col"> سال </th>
						<th scope="col"> ارزیابی مرکز </th>
                        <th scope="col"> خود ارزیابی </th>
                        <th scope="col"> میانگین ارزیابی </th>
                        <th scope="col" colspan="10"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($evaluations as $index => $evaluation)
						<tr>
							<th scope="row"> {{$index+1}} </th>
							@master
                                <td> {{$evaluation->branch->name ??  '-'}} </td>
                            @endmaster
							<td class="calibri"> {{$evaluation->year}} </td>
							<td>
                                @if ($evaluation->master_sum)
                                    <span class="calibri"> {{round($evaluation->master_sum, 2)}} </span>
                                @else
                                    <em class="text-danger"> تکمیل نشده </em>
                                @endif
                            </td>
							<td>
                                @if ($evaluation->self_sum)
                                    <span class="calibri"> {{round($evaluation->self_sum, 2)}} </span>
                                @else
                                    <em class="text-danger"> تکمیل نشده </em>
                                @endif
                            </td>
							<td>
                                @if ($evaluation->ave)
                                    <span class="calibri"> {{round($evaluation->ave, 2)}} </span>
                                @else
                                    <em class="text-danger"> نامشخص </em>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('eval.show', $evaluation->id)}}" class="btn btn-sm btn-outline-info"> جزییات </a>
                            </td>
                            <td>
                                <a href="{{route('evaluate', $evaluation->id)}}" class="btn btn-sm btn-outline-success">
                                    @master
                                        {{$evaluation->master_sum ? 'ویرایش' : 'تکمیل کردن'}}
                                    @else
                                        {{$evaluation->self_sum ? 'ویرایش' : 'تکمیل کردن'}}
                                    @endmaster
                                </a>
                            </td>
							@master
                                <td>
    								<form class="d-inline" action="{{route('eval.destroy', $evaluation->id)}}" method="post">
    									@csrf
    									@method('DELETE')
    									<a href="javascript:void" class="delete"> <i class="material-icons icon text-danger">delete</i> </a>
    								</form>
    							</td>
                            @endmaster
						</tr>
					@endforeach
				</tbody>
			</table>
            {{$evaluations->links()}}
		@else
			@include('includes.nothing_found')
		@endif

    </div>
@endsection
