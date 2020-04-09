@extends('layouts.dashboard')
@section('title')
    مدیریت منابع
@endsection
@section('content')
	<div class="tile text-md-left text-center">
		<a href="{{route('green_management')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به بخش مدیریت سبز
		</a>
	</div>
    <div class="tile">
        <h4> لیست همه منابع </h4>
        <hr>
        @if ($resources->count())
            <div class="row">
                @foreach ($resources as $resource)
                    <div class="col-md-3 my-3">
                        <form class="d-inline" action="{{route('resource.update', $resource->id)}}" method="post" id="update-{{$resource->id}}">
                            @csrf
                            @method('PUT')
                            <input type="text" class="form-control" name="name" value="{{$resource->name}}">
                        </form>
                        <div class="row mt-2">
                            <div class="col-6">
                                <button type="submit" form="update-{{$resource->id}}" class="btn btn-primary btn-block"> ویرایش </button>
                            </div>
                            <div class="col-6">
                                <form class="d-inline" action="{{route('resource.destroy', $resource->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-block delete"> حذف </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @include('includes.nothing_found')
        @endif
    </div>
    <div class="tile">
        <h4> اضافه کردن منبع جدید </h4>
        <hr>
        <form class="row justify-content-center" action="{{route('resource.store')}}" method="post">
            @csrf
            <div class="col-md-4">
                <label for="resource-name"> یک نام انتخاب کنید </label>
                <input id="resource-name" type="text" class="form-control" name="resource_name" value="{{old('resource_name')}}">
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
