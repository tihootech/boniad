@extends('layouts.dashboard')
@section('title')
    پنل شما
@endsection
@section('content')

    <div class="tile">

        @master
            <div class="row">
                @foreach ($branches as $branch)
                    <div class="col-md-6">
                        @if ($branch->indicators_not_completed())
                            <div class="alert alert-warning">
                                <h4> هشدار! </h4>
                                هدف کمی مربوط به شاخص های شعبه
                                <b> {{$branch->name}} </b>
                                تکمیل نشده اند.
                            </div>
                        @endif
                        @if ($branch->resources_not_completed())
                            <div class="alert alert-warning">
                                <h4> هشدار! </h4>
                                الگوی مصرف شعبه
                                <b> {{$branch->name}} </b>
                                تکمیل نشده است.
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endmaster

    </div>

@endsection
