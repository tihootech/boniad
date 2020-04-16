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
        <h4> جستجوی پسرفته </h4>
        <hr>
        <form class="row justify-content-center">
            @master
            <div class="col-md-3 form-group">
                <label for="branch"> انتخاب شعبه </label>
                <select class="select2" name="b[]" id="branch" multiple>
                    <option value="" disabled> انتخاب کنید </option>
                    @foreach ($branches as $branch)
                        <option value="{{$branch->id}}" @if(is_array(request('b')) && in_array($branch->id, request('b'))) selected @endif>
                            {{$branch->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            @endmaster
            <div class="col-md-3 form-group">
                <label for="resource"> انتخاب منبع </label>
                <select class="select2" name="r[]" id="resource" multiple>
                    <option value="" disabled> انتخاب کنید </option>
                    @foreach ($resources as $resource)
                        <option value="{{$resource->id}}" @if(is_array(request('r')) && in_array($resource->id, request('r'))) selected @endif>
                            {{$resource->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="month"> انتخاب ماه </label>
                <select class="select2" name="m[]" id="month" multiple>
                    <option value="" disabled> انتخاب کنید </option>
                    @foreach (persian_month_names() as $number => $month)
                        <option value="{{$number}}" @if(is_array(request('m')) && in_array($number, request('m'))) selected @endif>
                            {{$month}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="year"> سال </label>
                <input type="text" id="year" class="form-control" name="y" value="{{request('y')}}">
            </div>
            <hr class="w-100">
            <div class="col-md-3 col-lg-2">
                <button type="submit" class="btn btn-primary btn-block"> جستجو </button>
            </div>
        </form>
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
						<th scope="col"> هدف کمی </th>
						<th scope="col"> مقدار مصرف </th>
                        <th scope="col"> سال </th>
                        <th scope="col"> ماه </th>
                        <th scope="col"> فایل ضمیمه </th>
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
                            <td>
                                <span class="calibri">{{number_format($consumption->target)}}</span>
                                {{$consumption->resource->unit ?? '-'}}
                            </td>
							<td>
                                <span class="calibri {{$consumption->target < $consumption->amount ? 'text-info' : 'text-danger'}}
                                    @if($consumption->target == $consumption->amount) text-dark @endif">
                                    {{number_format($consumption->amount)}}
                                </span>
                                {{$consumption->resource->unit ?? '-'}}
                            </td>
							<td> {{$consumption->year}} </td>
							<td> {{persian_month_names($consumption->month)}} </td>
                            <td>
                                @if ($consumption->document)
                                    <a href="{{asset($consumption->document)}}" download> دانلود </a>
                                @else
                                    <em> - </em>
                                @endif
                            </td>
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
