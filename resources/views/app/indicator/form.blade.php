@extends('layouts.dashboard')
@section('title')
    @if($indicator->id) ویرایش شاخص @else تعریف شاخص جدید @endif
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('indicator.index')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به لیست شاخص ها
		</a>
	</div>
    <div class="tile">

		<form class="row justify-content-center" action="@if($indicator->id) {{route('indicator.update', $indicator->id)}} @else {{route('indicator.store')}} @endif" method="post">
            @csrf
            @if($indicator->id)
                @method('PUT')
            @endif

            <div class="col-md-12 form-group">
                <label for="title">عنوان شاخص</label>
                <input id="title" type="text" class="form-control" name="title" value="{{$indicator->title ?? old('title')}}" required>
            </div>

            <div class="col-md-4 form-group">
                <label for="cat"> انتخاب دسته بندی </label>
                <select class="form-control" id="cat" name="category_id" required>
                    <option value="">بدون دسته بندی</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $indicator->category_id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="points"> سقف امتیاز </label>
                <input id="points" type="number" class="form-control" name="points" value="{{$indicator->points ?? old('points')}}" required>
            </div>

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
