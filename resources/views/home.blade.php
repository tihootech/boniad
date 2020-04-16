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
        @else
            <h4 class="text-primary mb-3"> الگوی مصرف شما </h4>
            <div class="row">
                @if ($branch->resource_patterns->count())
                    @foreach ($branch->resource_patterns as $quantity)
                        <div class="col-md-3 my-2">
                            <div class="card">
                                <div class="card-body">
                                    <b class="text-primary"> {{$quantity->target->name ?? '-'}} : </b>
                                    <span class="calibri"> {{number_format($quantity->value)}} </span>
                                    <span> {{$quantity->target->unit ?? '-'}} </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning">
                        برای شما تعریف نشده است
                    </div>
                @endif
            </div>
            <hr>
            <h4 class="text-primary mb-3"> هدف کمی شاخص های تعریف شده برای شما </h4>
            <a href="#indicators-list" data-toggle="collapse">
                <i class="material-icons icon">keyboard_backspace</i>
                مشاهده لیست کامل
            </a>
            <div class="collapse" id="indicators-list">
                <div class="row">
                    @if ($branch->indicator_patterns->count())
                        @foreach ($branch->indicator_patterns as $quantity)
                            <div class="col-md-3 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <b> {{$quantity->target->title ?? '-'}} : </b>
                                        <span class="calibri text-primary"> {{number_format($quantity->value)}} </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            برای شما تعریف نشده است
                        </div>
                    @endif
                </div>
            </div>
        @endmaster

    </div>

@endsection
