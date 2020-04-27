@extends('layouts.dashboard')
@section('title')
    مدیریت سبز
@endsection
@section('content')
	<div class="tile text-md-left text-center">
		<a href="{{route('resource.index')}}" class="btn btn-primary mx-1">
			<i class="material-icons">opacity</i>
			مدیریت منابع
		</a>
		<a href="{{route('consumption.index')}}" class="btn btn-primary mx-1">
			<i class="material-icons">timeline</i>
			لیست کامل گزارش مصرف
		</a>
	</div>
    <div class="tile">
        <h4> گزارش ساز </h4>
        <hr>
        <form class="row justify-content-center">
            <div class="col-md-3 form-group">
                <label for="branch"> انتخاب شعبه </label>
                <select class="select2" name="b" id="branch" required>
                    <option value="" disabled selected> انتخاب کنید </option>
                    @foreach ($branches as $branch)
                        <option value="{{$branch->id}}" @if($request->b == $branch->id) selected @endif>
                            {{$branch->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="resource"> انتخاب منبع </label>
                <select class="select2" name="r" id="resource" required>
                    <option value="" disabled selected> انتخاب کنید </option>
                    @foreach ($resources as $resource)
                        <option value="{{$resource->id}}" @if($request->r == $resource->id) selected @endif>
                            {{$resource->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="year"> سال </label>
                <input type="number" id="year" class="form-control" name="y" required value="{{$request->y}}">
            </div>
            <hr class="w-100">
            <div class="col-md-3 col-lg-2">
                <button type="submit" class="btn btn-primary btn-block"> جستجو </button>
            </div>
        </form>
    </div>

    @if (count($consumptions))
        <div class="tile">
            <canvas id="canvas"></canvas>
        </div>
    @endif

@endsection

@section('charts')
	@if (count($consumptions))
        <script>
        var barChartData = {
            labels: [
                @foreach ($consumptions as $consumption)
                    '{{persian_month_names($consumption->month)}}',
                @endforeach
            ],
            datasets: [{
                label: 'مقدار مصرف شعبه',
                backgroundColor: '#10375C',
                borderColor: '#10375C',
                borderWidth: 1,
                data: [
                    @foreach ($consumptions as $consumption)
                        {{$consumption->amount}},
                    @endforeach
                ]
            }, {
                label: 'هدف کمی شعبه',
                backgroundColor: '#43A047',
                borderColor: '#43A047',
                borderWidth: 1,
                data: [
                    @foreach ($consumptions as $consumption)
                        {{$consumption->branch ? $consumption->branch->getQuantityValue('resource', $consumption->resource_id) : 0}},
                    @endforeach
                ]
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                }
            });

        };
        </script>
    @endif
@endsection
