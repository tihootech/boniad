@extends('layouts.dashboard')
@section('title')
    فرم ارزیابی
@endsection
@section('content')
    <form method="post">
        @csrf

        <div class="tile text-center">
            <h4> {{$category->name}} </h4>
            <hr>
            <b> <span class="calibri text-primary">{{$category->max_points}}</span> امتیاز </b>
        </div>

        <div class="tile">
            @foreach ($category->indicators as $index => $indicator)
                @if ($index)
                    <hr>
                @endif
                <p>{{$index+1}} - {{$indicator->title}} (سقف امتیاز : {{$indicator->points}}) </p>
                <div class="row">
                    <div class="col-md-10 form-group">
                        <input type="range" min="0" max="{{$indicator->points}}" name="answers[{{$indicator->id}}]"
                            value="{{$raw_answer = $indicator->raw_answer($evaluation->id)}}" class="indicator">
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="card card-body">
                            <span class="calibri result"> {{$raw_answer ?? ceil($indicator->points/2)}} </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="tile text-center">
            @if ($prev = $category->prev())
                <a href="{{route('evaluate', [$evaluation->id, $prev->id])}}" class="btn btn-info m-1">
                    <i class="material-icons">arrow_forward</i>
                    مرحله قبلی ({{$prev->name}})
                </a>
            @endif
            @if ($next = $category->next())
                <button type="submit" class="btn btn-primary m-1" formaction="{{route('eval.next', [$evaluation->id, $category->id])}}">
                    مرحله بعدی ({{$next->name}})
                    <i class="material-icons mr-2">keyboard_backspace</i>
                </button>
            @else
                <button type="submit" class="btn btn-primary m-1" formaction="{{route('eval.next', [$evaluation->id, $category->id])}}">
                    <i class="material-icons">done_all</i> خاتمه ارزیابی
                </button>
            @endif
        </div>

    </form>
@endsection
