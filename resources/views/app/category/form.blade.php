@extends('layouts.dashboard')
@section('title')
    @if($category->id) ویرایش دسته بندی @else تعریف دسته بندی جدید @endif
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('category.index')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به لیست دسته بندی ها
		</a>
	</div>
    <div class="tile">

		<form class="row justify-content-center" action="@if($category->id) {{route('category.update', $category->id)}} @else {{route('category.store')}} @endif" method="post">
            @csrf
            @if($category->id)
                @method('PUT')
            @endif

            <div class="col-md-5">
                <label for="name">نام دسته بندی</label>
                <input id="name" type="text" class="form-control" name="category_name" value="{{$category->name ?? old('category_name')}}" required>
            </div>

            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="material-icons">check</i>
                    تایید
                </button>
            </div>

        </form>

    </div>

@endsection
