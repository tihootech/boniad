@extends('layouts.dashboard')
@section('title')
    مدیریت سبز
@endsection
@section('content')
	<div class="tile text-md-left text-center">
		<a href="{{route('resource.index')}}" class="btn btn-primary">
			<i class="material-icons">opacity</i>
			مدیریت منابع
		</a>
	</div>
@endsection
@section('charts')
	<script>
		// for later
	</script>
@endsection
