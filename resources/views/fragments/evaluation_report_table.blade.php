<div class="table-responsive-lg">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th rowspan="2"> فعالیت ( دسته بندی )</th>
				<th rowspan="2"> توضیحات </th>
				<th rowspan="2"> واحد سنجش </th>
				<th rowspan="2"> هدف کمی </th>
				<th rowspan="2"> سقف امتیازات </th>
				<th colspan="4"> نتایج خود ارزیابی </th>
				<th colspan="4"> نتایج ارزیابی مرکز </th>
			</tr>
			<tr>
				@for ($i=0; $i < 2; $i++)
					@for ($q=1; $q <= 4; $q++)
						<th> سه ماهه {{translate_quarter($q)}} </th>
					@endfor
				@endfor
			</tr>
		</thead>
		<tbody>
			@foreach ($cats as $cat)
				@foreach ($cat->indicators as $indicator)
					<tr>
						<td> {{$cat->name}} </td>
						<td> {{$indicator->title}} </td>
						<td>
							@if ($branch->getQuantityValue('indicator', $indicator->id) == 100)
								درصد
							@else
								تعداد
							@endif
						</td>
						<td> {{$branch->getQuantityValue('indicator', $indicator->id)}} </td>
						<td> {{$indicator->points}} </td>
						@for ($registered_by_master=0; $registered_by_master < 2; $registered_by_master++)
							@for ($q=1; $q <= 4; $q++)
								@php
									$evaluation = \App\Evaluation::where('branch_id', $active_branch->id)->where('quarter', $q)->where('year', $request->y)->first();
								@endphp
								<td class="calibri">
									@if ($evaluation)
										{{ round( $evaluation->getPointFor($indicator->id, $registered_by_master), 1) }}
									@else
										-
									@endif
								</td>
							@endfor
						@endfor
					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>

</div>
