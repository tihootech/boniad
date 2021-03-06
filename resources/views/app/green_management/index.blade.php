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
        <h4 class="text-center text-primary mb-3"> لیست همه منابع </h4>
        @if ($resources->count())
            <div class="row">
                @foreach ($resources as $resource)
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <div class="card-body">
                                <form class="d-inline" action="{{route('resource.update', $resource->id)}}" method="post" id="update-{{$resource->id}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name"> نام منبع </label>
                                            <input type="text" id="name" class="form-control my-1" name="name" value="{{$resource->name}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="unit"> واحد مصرف </label>
                                            <input type="text" id="unit" class="form-control my-1" name="unit" value="{{$resource->unit}}">
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-2">
                                    <div class="col-md-3 my-1">
                                        <button type="submit" form="update-{{$resource->id}}" class="btn btn-success btn-block"> ویرایش </button>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <a href="{{route('quantity.edit_pattetn', ['resource', $resource->id])}}" class="btn btn-info btn-block">
                                            مدیریت الگوی مصرف
                                        </a>
                                    </div>
                                    <div class="col-md-3 my-1">
                                        <form class="d-inline" action="{{route('resource.destroy', $resource->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-block delete"> حذف </button>
                                        </form>
                                    </div>
                                </div>
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
            <div class="col-md-4">
                <label for="resource-unit"> واحد مصرف </label>
                <input id="resource-unit" type="text" class="form-control" name="resource_unit" value="{{old('resource_unit')}}">
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
