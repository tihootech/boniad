@extends('layouts.dashboard')
@section('title')
    لیست ارزیابی های قبلی
@endsection
@section('content')
    <div class="tile text-md-left text-center">
		<a href="{{route('eval.list')}}" class="btn btn-primary">
			<i class="material-icons">arrow_forward</i>
			بازگشت به لیست ارزیابی ها
		</a>
	</div>
    <div class="tile">

        <form class="row justify-content-center" action="{{route('eval.store')}}" method="post">
            @csrf

            @master
                <div class="col-md-4 form-group">
                    <label for="branch"> بنیاد مورد نظر جهت ارزیابی را انتخاب کنید </label>
                    <select class="select2" id="branch" name="branch_id" required>
                        <option value="">انتخاب کنید</option>
                        @foreach ($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endmaster
            <div class="col-md-3">
                <label for="year"> سال مورد نظر را وارد کنید </label>
                <input id="year" type="number" class="form-control" name="year" required>
            </div>
            <div class="col-md-3 form-group">
                <label for="quarter"> انتخاب ماه </label>
                <select class="form-control" name="quarter" id="quarter" required>
                    <option value=""> انتخاب کنید </option>
                    @for ($number=1; $number <= 4; $number++)
                        <option value="{{$number}}">
                            سه ماهه {{translate_quarter($number)}}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 align-self-center">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="material-icons">add</i>
                    شروع ارزیابی جدید
                </button>
            </div>
        </form>

    </div>
    @if ($unfinished_evaluations->count())
        <div class="tile">
            <h4> ارزیابی های معلق </h4>
            <hr>
            <div class="row">
                @foreach ($unfinished_evaluations as $evaluation)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                ارزیابی بنیاد
                                <span class="text-primary"> {{$evaluation->branch->name ?? '-'}} </span>
                                سال <span class="text-primary"> {{$evaluation->year}} </span>
                                @master
                                    <br>
                                    تکمیل شده توسط خود بنیاد : <span class="text-primary"> {{$evaluation->self_sum ? 'بلی' : 'خیر'}} </span>
                                @endmaster
                                <hr>

                                <a href="{{route('evaluate', $evaluation->id)}}" class="btn btn-primary m-1">
                                    <i class="material-icons">keyboard_backspace</i> ورود به ارزیابی
                                </a>

                                @master
                                    <form class="d-inline" action="{{route('eval.destroy', $evaluation->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void" class="btn btn-danger m-1 delete">
                                            <i class="material-icons">delete</i> حذف
                                        </a>
                                    </form>
                                @endmaster

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
