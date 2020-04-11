@extends('layouts.dashboard')
@section('title')
    ارزیابی شعبه
    {{$evaluation->branch->name ?? '-'}}
    سال
    {{$evaluation->year}}
@endsection
@section('content')

    <div class="tile text-md-left text-center">
		<a href="{{route('eval.list')}}" class="btn btn-primary btn-sm m-1">
			<i class="material-icons">arrow_forward</i>
			بازگشت به لیست ارزیابی ها
		</a>
		<a href="{{route('eval.landing')}}" class="btn btn-primary btn-sm m-1">
			<i class="material-icons">arrow_forward</i>
			بازگشت به بخش ارزیابی
		</a>
	</div>

    <div class="tile">

        <h4>
            ارزیابی شعبه
            {{$evaluation->branch->name ?? '-'}}
            سال
            {{$evaluation->year}}
        </h4>

        <h5 class="text-primary text-center my-2"> نتایج بر حسب دسته بندی ها </h5>
        @include('fragments.evaluation_result_table')

        <hr>
        <h5 class="text-primary text-center my-2"> جزییات هر دسته بندی </h5>
        @foreach ($categories as $category)

            <a href="#cat-{{$category->id}}" data-toggle="collapse" class="d-block my-3">
                <i class="material-icons icon">keyboard_backspace</i>
                {{$category->name}}
            </a>

            <div class="collapse" id="cat-{{$category->id}}">
                @include('fragments.indicators_result_table')
            </div>

        @endforeach

    </div>
@endsection
