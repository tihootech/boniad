<div class="table-responsive-lg">
	<table class="table table-bordered table-hover table-striped mt-3">
		<thead>
			<tr>
				<th> ردیف </th>
				<th> عنوان شاخص </th>
				<th> حداکثر امتیاز </th>
				<th> نتیجه خود ارزیابی </th>
				<th> نتیجه ارزیابی مرکز </th>
				<th> فایل ضمیمه </th>
				<th> میانگین </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($category->indicators as $index => $indicator)
				@php
					$self = $indicator->point_for($evaluation->id, false);
					$master = $indicator->point_for($evaluation->id, true);
				@endphp
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$indicator->title}}</td>
					<td class="calibri">{{$indicator->points}}</td>
					<th class="calibri {{$self > $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
						{{round($self, 1)}}
					</th>
					<th class="calibri {{$self < $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
						{{round($master, 1)}}
					</th>
					<th>
						@if ($path = $indicator->uploaded_documnet($evaluation->id))
							<a href="{{asset($path)}}" download> دانلود </a>
						@else
							<em> - </em>
						@endif
					</th>
					<th>
						@if (!is_null($self) && !is_null($master))
							<span class="calibri"> {{ round(($self+$master)/2 , 1) }} </span>
						@else
							<em class="text-warning"> نامشخص </em>
						@endif
					</th>
				</tr>
			@endforeach
			@php
				$self = $category->points_for($evaluation->id, false);
				$master = $category->points_for($evaluation->id, true);
			@endphp
			<tr>
				<th> # </th>
				<th> مجموع </th>
				<td class="calibri"> {{$category->max_points}} </td>
				<th class="calibri {{$self > $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
					{{round($self, 1) ?? '-'}}
				</th>
				<th class="calibri {{$self < $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
					{{round($master, 1) ?? '-'}}
				</th>
				<th>-</th>
				<th>
					@if ($self && $master)
						<span class="calibri"> {{ round(($self+$master)/2 , 1) }} </span>
					@else
						<em class="text-warning"> نامشخص </em>
					@endif
				</th>
			</tr>
		</tbody>
	</table>

</div>
