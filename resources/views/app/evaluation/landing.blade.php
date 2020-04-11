@extends('layouts.dashboard')
@section('title')
    ارزیابی
@endsection
@section('content')
	<div class="tile text-md-left text-center">
		<a href="{{route('eval.new')}}" class="btn btn-primary mx-1">
			<i class="material-icons">add</i>
			@master
                ارزیابی شعب توسط مرکز
            @else
                ارزیابی جدید
            @endmaster
		</a>
		<a href="{{route('eval.list')}}" class="btn btn-primary mx-1">
			<i class="material-icons">list</i>
            لیست ارزیابی ها
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
