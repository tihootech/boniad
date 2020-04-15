@extends('layouts.dashboard')
@section('title')
    فرم ارزیابی
@endsection
@section('content')
    <form method="post" enctype="multipart/form-data">
        @csrf

        <div class="tile text-center">
            <h4> {{$category->name}} </h4>
            <hr>
            <b> <span class="calibri text-primary">{{$category->max_points}}</span> امتیاز </b>
        </div>

        <div class="tile">
            @foreach ($category->indicators as $index => $indicator)
                <div class="table-responsive-lg">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> شاخص </th>
                                <th> سقف امتیازات </th>
                                <th> هدف کمی </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> {{$indicator->title}} </td>
                                <td class="calibri"> {{$indicator->points}} </td>
                                <th class="calibri text-danger"> {{$indicator->quantity_target($evaluation->branch_id)}} </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 form-group align-self-center">
                        <label for="ia-{{$indicator->id}}" class="text-primary">
                            {{$index+1}}. {{$indicator->title}}
                        </label>
                        <input type="number" min="0" max="{{$indicator->quantity_target($evaluation->branch_id)}}" name="answers[{{$indicator->id}}]"
                            value="{{$indicator->raw_answer($evaluation->id)}}" class="form-control eval-answer" id="ia-{{$indicator->id}}" required>
                        <div class="alert alert-danger mt-2 indicator-limit-error hidden">
                            <i class="material-icons icon">error</i>
                            عدد وارد شده باین بین صفر و
                            <span class="calibri"> {{$indicator->quantity_target($evaluation->branch_id)}} </span>
                            باشد.
                        </div>
                    </div>
                    @if (!master() && $indicator->document)
                        <div class="col-lg-4 col-md-6 form-group">
                            <label for="doc-{{$indicator->id}}">
                                <span class="text-primary"> بارگذاری مستندات </span>
                                @if ($indicator->uploaded_documnet($evaluation->id))
                                    <br>
                                    <em class="text-danger">
                                        شما برای این شاخص قبل مستندات آپلود کرده اید. در صورت تمایل میتوانید مجددا فایل جدید آپلود کنید
                                    </em>
                                @endif
                            </label>
                            <input type="file" id="doc-{{$indicator->id}}" name="documents[{{$indicator->id}}]" class="form-control"
                                @unless($indicator->uploaded_documnet($evaluation->id)) required @endunless>
                        </div>
                    @endif
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
