@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Users
            <small>it all starts here</small>
            <a class="btn btn-success" href="{{ route('back.users.create') }}">Create new</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a class="" href="#">Create Users</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('back.message')
                <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create User</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('back.users.save')  }}" method="post">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="">Select Your AU City</label>

                        <select class="form-control" name="user_city" id="">
                            @foreach( \App\Models\City::all() as $city )
                                <option value="{{ $city->externalCode }}">{{ $city->cityName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Select Role</label>

                        <select class="form-control" name="user_city" id="">
                            @foreach( \App\Models\UsersRole::all() as $role )
                                <option value="{{ $role->roleid }}">{{ $role->roleTitle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">User Refferal</label>
                        <input type="text" name="user_refferal" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="">User status</label>
                        <select name="user_status" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div><!-- /.box-body -->

        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection