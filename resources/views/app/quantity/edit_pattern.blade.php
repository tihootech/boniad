@extends('layouts.dashboard')
@section('title')
    @if ($type == 'resource')
        مدیریت الگوی مصرف : {{$object->name}}
    @else
        مدیریت هدف کمی شاخص : {{$object->title}}
    @endif
@endsection
@section('content')

	<form action="{{route('quantity.update_pattetn', [$type, $id])}}" method="post">
		@csrf
		@method('PUT')

        <div class="tile">
            @if ($type == 'resource')
                <h4 class="text-center text-primary mb-3">
                    مدیریت الگوی مصرف : <span class="text-info"> {{$object->name}} </span>
                    <br>
                    <small>
                        عدد را بر حسب
                        <b class="text-info"> {{$object->unit}} </b>
                        وارد کنید.
                    </small>
                </h4>
            @endif
            @if ($type == 'indicator')
                <h4 class="text-center mb-3">
                    مدیریت هدف کمی شاخص :
                    <span class="text-primary">{{$object->title}}</span>
                </h4>
            @endif
            <hr>
            <div class="row">
                @foreach ($branches as $branch)
                    <div class="col-lg-3 col-md-4 form-group align-self-end">
                        <p> {{$branch->name}} </p>
                        <input type="number" min="1" class="form-control" name="branches[{{$branch->id}}]" required
                            value="{{$object->quantity_target($branch->id)}}">
                    </div>
                @endforeach
            </div>
        </div>

		<div class="tile text-center">
			<button type="submit" class="btn btn-primary">
				<i class="material-icons">check</i>
				تایید
			</button>
		</div>

	</form>

@endsection
