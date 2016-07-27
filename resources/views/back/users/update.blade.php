@extends('back.master')
@section('content')

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Users
      <small>it all starts here</small>
      <a class="btn btn-success" href="{{ route('back.users.create') }}">Create new</a>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Edit Users</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <!-- Default box -->
    <div class="box">
      	<div class="box-header with-border">
        	<h3 class="box-title">Edit User</h3>
      	</div>
      	<div class="box-body">
			<form action="{{route('back.users.edit.save',$user->id)}}" method="post">
				<input type="hidden" value="{{ csrf_token() }}" name="_token">
				<input type="hidden" value="{{ $user->id }}" name="id">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="name" class="form-control" value="{{ $user->name }}">
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="text" readonly="" name="email" class="form-control" value="{{ $user->email }}">
				</div>
				<div class="form-group">
					<label for="">User Code</label>
					<input type="text" name="user_code" readonly="" class="form-control" value="{{ $user->user_code }}">
				</div>
				<div class="form-group">
					<label for="">Member Code</label>
					<input type="text" name="user_code" readonly="" class="form-control" value="{{ $user->membership_number }}">
				</div>
				<div class="form-group">
					<label for="">User Refferal</label>
					<input type="text" name="user_refferal" class="form-control" value="{{ $user->user_refferal }}">
				</div>
				<div class="form-group">
					<label for="">User Role</label>
					<select name="user_role" id="" class="form-control">
						@foreach( App\Models\UsersRole::all() as $item )
							<option {{ ($user->user_role == $item->roleid) ? 'selected' :''  }} value="{{ $item->roleid }}">{{ $item->roleTitle }}</option>
						@endforeach	
					</select>
				</div>

				<div class="form-group">
					<label for="">User status</label>
					<select name="user_status" id="" class="form-control">
						<option {{ ($user->user_status == 1)?'selected':'' }} value="1">Active</option>
						<option {{ ($user->user_status == 0)?'selected':'' }} value="0">Blocked</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">Save</button>
			</form>
        </div><!-- /.box-body -->
      
    </div><!-- /.box -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection