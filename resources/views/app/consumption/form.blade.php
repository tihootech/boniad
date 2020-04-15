@extends('layouts.dashboard')
@section('title')
    @if($consumption->id) ویرایش گزارش مصرف @else تعریف گزارش مصرف جدید @endif
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('consumption.index')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به بخش گزارش مصرف
		</a>
	</div>

    <div class="tile">

		<form class="row justify-content-center align-items-center" method="post" enctype="multipart/form-data"
            action="@if($consumption->id) {{route('consumption.update', $consumption->id)}} @else {{route('consumption.store')}} @endif">
            @csrf
            @if($consumption->id)
                @method('PUT')
            @endif

            <div class="col-md-3 form-group">
                <label for="res"> انتخاب منبع </label>
                <select class="form-control" id="res" name="resource_id" required>
                    <option value="">انتخاب کنید</option>
                    @foreach ($resources as $resource)
                        <option value="{{$resource->id}}" @if($resource->id == $consumption->resource_id) selected @endif>
                            {{$resource->name}}
                            ({{$resource->unit}})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="amount"> مقدار مصرف </label>
                <input id="amount" type="number" class="form-control" name="amount" value="{{$consumption->amount ?? old('amount')}}" required>
            </div>

            <div class="col-md-2 form-group">
                <label for="month"> انتخاب ماه </label>
                <select class="form-control" id="month" name="month" required>
                    <option value="">انتخاب کنید</option>
                    @foreach (persian_month_names() as $number => $name)
                        <option value="{{$number}}" @if($number == $consumption->month) selected @endif>{{$name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="year"> سال </label>
                <input id="year" type="number" class="form-control" name="year" value="{{$consumption->year ?? old('year')}}" required>
            </div>

            <div class="col-md-3 form-group">
                <label for="document">
                    بارگذاری قبض
                </label>
                <input id="document" type="file" class="form-control" name="document">
            </div>

            @if ($consumption->document)
                <div class="col-12 text-center">
                    <p class="text-danger"> شما قبلا قبض خود را آپلود کرده اید. در صورت تمایل میتوانید با آپلود مجدد فایل قبلی را جایگزین کنید </p>
                </div>
            @endif
            <hr class="w-100">

            <div class="col-md-2 align-self-center">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="material-icons">check</i>
                    تایید
                </button>
            </div>

        </form>

    </div>

@endsection
