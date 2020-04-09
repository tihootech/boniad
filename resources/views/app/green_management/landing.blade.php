@extends('layouts.dashboard')
@section('title')
    مدیریت سبز
@endsection
@section('content')
	<div class="tile text-md-left text-center">
		<a href="{{route('resource.index')}}" class="btn btn-primary mx-1">
			<i class="material-icons">opacity</i>
			مدیریت منابع
		</a>
		<a href="{{route('consumption.index')}}" class="btn btn-primary mx-1">
			<i class="material-icons">timeline</i>
			لیست کامل گزارش مصرف
		</a>
	</div>
    <div class="tile">
        در این قسمت بعدا آمار ها و نموداری های دلخواه نمایش داده میشود.
    </div>
@endsection
@section('charts')
	<script>
		// for later
	</script>
@endsection
