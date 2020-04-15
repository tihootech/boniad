<div class="table-responsive-lg">
	<table class="table table-striped mt-3">
		<thead>
			<tr>
				<th> دسته بندی </th>
				<th> حداکثر امتیاز </th>
				<th> نتایج خود ارزیابی </th>
				<th> نتایج ارزیابی مرکز </th>
				<th> میانگین </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $category)
				@php
					$self = $category->points_for($evaluation->id, false);
					$master = $category->points_for($evaluation->id, true);
				@endphp
				<tr>
					<td>{{$category->name}}</td>
					<td class="calibri">{{$category->max_points}}</td>
					<th class="calibri {{$self > $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
						{{round($self, 1)}}
					</th>
					<th class="calibri {{$self < $master ? 'text-info' : 'text-danger'}} @if($self == $master) text-dark @endif">
						{{round($master, 1)}}
					</th>
					<th>
						@if ($self && $master)
							<span class="calibri"> {{($self+$master)/2}} </span>
						@else
							<em class="text-warning"> نامشخص </em>
						@endif
					</th>
				</tr>
			@endforeach
			<tr>
				<th> مجموع </th>
				<td class="calibri"> {{all_indicators_total_max_points()}} </td>
				<th class="calibri
					{{$evaluation->self_sum > $evaluation->master_sum ? 'text-info' : 'text-danger'}}
					@if($evaluation->self_sum == $evaluation->master_sum) text-dark @endif
				">
					{{$evaluation->self_sum ?? '-'}}
				</th>
				<th class="calibri
					{{$evaluation->self_sum < $evaluation->master_sum ? 'text-info' : 'text-danger'}}
					@if($evaluation->self_sum == $evaluation->master_sum) text-dark @endif
				">
					{{$evaluation->master_sum ?? '-'}}
				</th>
				<th>
					@if ($evaluation->ave)
						<span class="calibri"> {{$evaluation->ave}} </span>
					@else
						<em class="text-warning"> نامشخص </em>
					@endif
				</th>
			</tr>
		</tbody>
	</table>

</div>
