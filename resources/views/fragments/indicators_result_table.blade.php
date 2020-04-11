<div class="table-responsive-lg">
	<table class="table table-bordered table-hover table-striped mt-3">
		<thead>
			<tr>
				<th> ردیف </th>
				<th> عنوان شاخص </th>
				<th> حداکثر امتیاز </th>
				<th> نتیجه خود ارزیابی </th>
				<th> نتیجه ارزیابی مرکز </th>
				<th> میانگین </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($category->indicators as $index => $indicator)
				@php
					$self = $indicator->raw_answer($evaluation->id, false);
					$master = $indicator->raw_answer($evaluation->id, true);
				@endphp
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$indicator->title}}</td>
					<td class="calibri">{{$indicator->points}}</td>
					<th class="calibri {{$self > $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">{{$self}}</th>
					<th class="calibri {{$self < $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">{{$master}}</th>
					<th>
						@if ($self && $master)
							<span class="calibri"> {{($self+$master)/2}} </span>
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
					{{$self ?? '-'}}
				</th>
				<th class="calibri {{$self < $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
					{{$master ?? '-'}}
				</th>
				<th>
					@if ($self && $master)
						<span class="calibri"> {{($self+$master)/2}} </span>
					@else
						<em class="text-warning"> نامشخص </em>
					@endif
				</th>
			</tr>
		</tbody>
	</table>

</div>
