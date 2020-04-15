@extends('layouts.dashboard')
@section('title')
    مدیریت شعب
@endsection
@section('content')

	<div class="tile text-md-left text-center">
		<a href="{{route('branch.create')}}" class="btn btn-primary">
			<i class="material-icons">add</i>
			تعریفه شعبه جدید
		</a>
	</div>
    <div class="tile">

		@if ($branches->count())

			<div class="table-responsive-lg">
                <table class="table table-bordered table-striped table-hover">
    				<thead>
    					<tr>
    						<th scope="col"> ردیف </th>
    						<th scope="col"> نام شعبه </th>
    						<th scope="col"> نام کاربری جهت ورود به سیستم </th>
    						<th scope="col" colspan="4"> عملیات </th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach ($branches as $index => $branch)
    						<tr>
    							<th scope="row"> {{$index+1}} </th>
    							<td> {{$branch->name}} </td>
    							<td> {{$branch->user->name ?? 'Database Error'}} </td>
    							<td>
    								<a href="{{route('quantity.edit', $branch->id)}}" class="btn btn-outline-info btn-sm">
                                        مدیریت هدف کمی
                                    </a>
    							</td>
    							<td>
    								<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#change-branch-password"
                                        data-branch-id="{{$branch->id}}" data-branch-name="{{$branch->name}}">
                                        تغییر رمز عبور
                                    </button>
    							</td>
    							<td>
    								<a href="{{route('branch.edit', $branch->id)}}"> <i class="material-icons icon">edit</i> </a>
    							</td>
    							<td>
    								<form class="d-inline" action="{{route('branch.destroy', $branch->id)}}" method="post">
    									@csrf
    									@method('DELETE')
    									<a href="javascript:void" class="delete"> <i class="material-icons icon text-danger">delete</i> </a>
    								</form>
    							</td>
    						</tr>
    					@endforeach
    				</tbody>
    			</table>
            </div>

            <div class="modal fade" id="change-branch-password" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تغییر رمز عبور</h5>
                            <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('master_acc_update')}}" method="post" id="change-password-form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="branch_id" id="branch-id-target" value="">
                                <div class="form-group">
                                    <label for="new-password" class="col-form-label">
                                        رمز عبور جدید برای شعبه
                                        <span id="branch-name" class="text-primary"></span>
                                    </label>
                                    <input type="text" class="form-control" id="new-password" name="pwd" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary ml-1" data-dismiss="modal"> انصراف </button>
                            <button type="submit" form="change-password-form" class="btn btn-primary"> تغییر رمز عبور </button>
                        </div>
                    </div>
                </div>
            </div>

		@else
			@include('includes.nothing_found')
		@endif

    </div>

@endsection
