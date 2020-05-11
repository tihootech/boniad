@extends('layouts.dashboard')
@section('title')
    گزارش گیری
@endsection
@section('content')

	<div class="tile">

		<form class="row justify-content-center" method="GET">

			<div class="col-md-3 form-group">
                <label for="branch"> انتخاب بنیاد </label>
                <select class="select2" name="b" id="branch" required>
                    <option value="" disabled selected> انتخاب کنید </option>
                    @foreach ($branches as $branch)
                        <option value="{{$branch->id}}" @if($request->b == $branch->id) selected @endif>
                            {{$branch->name}}
                        </option>
                    @endforeach
                </select>
            </div>
			<div class="col-md-3">
				<label for="year"> سال </label>
				<input type="number" class="form-control" name="y" value="{{$request->y}}" required>
			</div>
			<div class="col-md-3 form-group">
                <label for="type"> نوع گزارش </label>
                <select class="form-control" name="t" id="type" required>
					<option value="1" @if($request->t == 1) selected @endif> الگوی مصرف </option>
					<option value="2" @if($request->t == 2) selected @endif> ارزیابی </option>
                </select>
            </div>
			<hr class="w-100">
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary btn-block"> تایید </button>
			</div>
		</form>

	</div>

	@if ($active_branch)


		@if ($request->t == 1)
			<div class="tile">
				<h4 class="text-center mb-4"> الگوی مصرف بنیاد شهید شهرستان <span class="text-primary"> {{$active_branch->name}} </span> </h4>

				<div class="table-responsive-lg">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th rowspan="2"> فهرست </th>
								<th colspan="5"> هدف گذاری سالیانه </th>
								<th rowspan="2"> واحد سنجش </th>
								<th colspan="5"> کنترل </th>
								<th rowspan="2"> وضعیت مصرف </th>
							</tr>
							<tr>
								@for ($i=0; $i < 2; $i++)
									@for ($q=1; $q <= 4; $q++)
										<th> سه ماهه {{translate_quarter($q)}} </th>
									@endfor
									<th> جمع </th>
								@endfor
							</tr>
						</thead>
						<tbody>
							@foreach ($resources as $resource)
								@php
									$qsum = 0;
									$csum = 0;
								@endphp
								<tr>
									<th scope="row"> {{$resource->name}} </th>
									@for ($q=1; $q <= 4; $q++)
										<td class="calibri">
											{{ number_format($active_branch->getQuantityValue('resource', $resource->id)) }}
										</td>
                                        @php
                                            $qsum += $active_branch->getQuantityValue('resource', $resource->id)
                                        @endphp
									@endfor
									<td class="calibri"> {{ number_format($qsum) }} </td>
									<td> {{$resource->unit}} </td>
									@for ($q=1; $q <= 4; $q++)
										<td class="calibri">
											{{ number_format($active_branch->getConsumptionAmount($resource->id, $request->y, $q)) }}
										</td>
                                        @php
                                            $csum += $active_branch->getConsumptionAmount($resource->id, $request->y, $q)
                                        @endphp
									@endfor
									<td class="calibri"> {{number_format($csum)}} </td>
									<td>
										@if ($csum > $qsum)
											<span class="text-danger"> غیر بهینه </span>
										@elseif($csum)
											<span class="text-info"> بهینه </span>
										@else
											گزارشی موجود نیست
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>

			<div class="tile">
				<canvas id="canvas"></canvas>
			</div>
		@endif

		@if ($request->t == 2)
			<div class="tile">
				<h4 class="text-center mb-4"> شاخص های عمومی </h4>
				@if ($generals->count())
					@include('fragments.evaluation_report_table', ['cats' => $generals])
				@else
					<div class="alert alert-warning text-center">
						هنوز هیچ شاخص
						عمومی
						در سیستم ثبت نشده است.
					</div>
				@endif
			</div>


			<div class="tile">
				<h4 class="text-center mb-4"> شاخص های اختصاصی </h4>
				@if ($exclusives->count())
					@include('fragments.evaluation_report_table', ['cats' => $exclusives])
				@else
					<div class="alert alert-warning text-center">
						هنوز هیچ شاخص
						اختصاصی
						در سیستم ثبت نشده است.
					</div>
				@endif
			</div>
		@endif

	@endif

@endsection

@section('charts')
	@if ($request->t == 1)
        <script>

        var barChartData = {
            labels: [
                @foreach ($resources as $resource)
					@for ($q=1; $q <= 4; $q++)
						'مصرف {{$resource->name}} - سه ماهه {{translate_quarter($q)}}',
					@endfor
                @endforeach
            ],
            datasets: [{
                label: 'مقدار مصرف بنیاد',
                backgroundColor: '#10375C',
                borderColor: '#10375C',
                borderWidth: 1,
                data: [
					@foreach ($resources as $resource)
						@for ($q=1; $q <= 4; $q++)
							{{$active_branch->getQuantityValue('resource', $resource->id)}},
						@endfor
	                @endforeach
                ]
            }, {
                label: 'هدف کمی بنیاد',
                backgroundColor: '#43A047',
                borderColor: '#43A047',
                borderWidth: 1,
                data: [
					@foreach ($resources as $resource)
						@for ($q=1; $q <= 4; $q++)
							{{$active_branch->getConsumptionAmount($resource->id, $request->y, $q)}},
						@endfor
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
