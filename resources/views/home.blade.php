@extends('layouts.dashboard')
@section('title')
    پنل شما
@endsection
@section('content')

    <div class="tile">

        @master
            <div class="row">
                @foreach ($branches as $branch)
                    @if ($branch->indicators_not_completed() || $branch->resources_not_completed())
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
                            <div class="text-center">
                                <a href="{{route('quantity.edit', $branch->id)}}" class="btn btn-outline-primary"> تکمیل کردن </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endmaster

    </div>

@endsection
