@extends('layouts.dashboard')
@section('title')
    @if($branch->id) ویرایش بنیاد @else تعریف بنیاد جدید @endif
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('branch.index')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به لیست بنیاد ها
		</a>
	</div>
    <div class="tile">

		<form class="row justify-content-center" action="@if($branch->id) {{route('branch.update', $branch->id)}} @else {{route('branch.store')}} @endif" method="post">
            @csrf
            @if($branch->id)
                @method('PUT')
            @endif

            <div class="col-md-5">
                <label for="name">نام بنیاد</label>
                <input id="name" type="text" class="form-control" name="branch_name" value="{{$branch->name ?? old('branch_name')}}" required>
            </div>

            @unless ($branch->id)

                <div class="col-md-3">
                    <label for="username">نام کاربری (جهت ورود به پنل)</label>
                    <input id="username" type="text" class="form-control" name="username" value="{{old('username')}}" required>
                </div>

                <div class="col-md-3">
                    <label for="password">رمزعبور</label>
                    <input id="password" type="text" class="form-control" name="pwd" value="{{old('pwd')}}" required>
                </div>

            @endunless

            <hr class="w-100">

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="material-icons">check</i>
                    تایید
                </button>
            </div>

        </form>

    </div>

@endsection
