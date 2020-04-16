@extends('layouts.dashboard')
@section('title')
    مدیریت شاخص ها
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('indicator.create')}}" class="btn btn-primary">
			<i class="material-icons">add</i>
			تعریفه شاخص جدید
		</a>
	</div>
    <div class="tile text-center">
        <a href="{{route('indicator.index')}}" class="btn btn-outline-primary btn-sm m-1"> همه دسته بندی ها </a>
        @foreach ($categories as $category)
            <a href="?cat={{$category->id}}" class="btn @if($category->id == request('cat')) btn-info @else btn-outline-info @endif btn-sm m-1">
                {{$category->name}}
            </a>
        @endforeach
        <hr>
        <form class="row justify-content-center">
            <div class="col-lg-3 col-md-6 form-group">
                <input type="text" name="i" value="{{request('i')}}" placeholder="جستجو شاخص" class="form-control">
            </div>
            <div class="col-lg-2 col-md-3 form-group">
                <button type="submit" class="btn btn-primary btn-block"> جستجو </button>
            </div>
        </form>
    </div>
    <div class="tile">

		@if ($indicators->count())

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col"> ردیف </th>
						<th scope="col"> عنوان شاخص </th>
						<th scope="col"> سقف امتیازات </th>
                        <th scope="col"> آپلود مدارک </th>
                        <th scope="col"> دسته بندی </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($indicators as $index => $indicator)
						<tr>
							<th scope="row"> {{$index+1}} </th>
							<td> {{$indicator->title}} </td>
							<td> {{$indicator->points}} </td>
							<td>
                                @if ($indicator->document)
                                    <span class="text-success"> بلی </span>
                                @else
                                    <span class="text-danger"> خیر </span>
                                @endif
                            </td>
							<td> {{$indicator->category->name ?? '-'}} </td>
							<td>
								<a href="{{route('indicator.edit', $indicator->id)}}"> <i class="material-icons icon">edit</i> </a>
							</td>
							<td>
								<form class="d-inline" action="{{route('indicator.destroy', $indicator->id)}}" method="post">
									@csrf
									@method('DELETE')
									<a href="javascript:void" class="delete"> <i class="material-icons icon text-danger">delete</i> </a>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
            {{$indicators->appends($_GET)->links()}}
		@else
			@include('includes.nothing_found')
		@endif

    </div>

@endsection
