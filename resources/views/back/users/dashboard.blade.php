@extends('back.master')
@section('content')


<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All Users
      <small>it all starts here</small>
      <a class="btn btn-success" href="{{ route('back.product.create') }}">Create new</a>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Users</a></li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">User</h3>
      </div>
      <div class="box-body">
        <form action="{{route('back.users.post')}}" class="form-inline" method="post">
          <input type="hidden" value="{{ csrf_token() }}" name="_token">
        
          <div class="clearfix">
            <p class="pull-right"> Showing <strong>{{$users->count()}}</strong> users </p>
          </div>
          
       		<table id="data-table" class="table table-bordered table-hover">
            <thead>
                    <tr>
                      <td>Name</td>
                      <td>Email</td>
                     <td>Name suffix </td>
                     <td>User code </td>
                     <td>User refferal </td>
                     <td>Registration date</td>
                     <td>Status</td>
                      <td>Register fee</td>
                      <td>Action</td>
                    </tr>
            </thead>
       			
            <tr>
    
              <td><input value="{{Input::get('filter')['name']}}" type="text" name="filter[name]" class="form-control" placeholder=""></td>
              <td><input value="{{Input::get('filter')['email']}}" type="email" name="filter[email]" class="form-control" placeholder=""></td>
              <td></td>
              <td><input value="{{Input::get('filter')['user_code']}}" type="text" size="12" name="filter[user_code]" class="form-control" placeholder=""></td>
              <td><input value="{{Input::get('filter')['user_refferal']}}" type="text" size="12"  name="filter[user_refferal]" class="form-control" placeholder=""></td>
              <td>
                <input value="{{Input::get('filter')['registration_date']}}" type="text" size="8" name="filter[registration_date]" class="form-control reservation" placeholder="From - To"><br>
              </td>
              <td><select name="filter[user_status]" id="" class="form-control">
                <option value="">Select</option>
                <option value="1" {{ (Input::get('filter')['user_status'] == '1') ? 'selected':''  }}>Active</option>
                <option value="0" {{ (Input::get('filter')['user_status'] == '0') ? 'selected':''  }}>Disactive</option>
              </select></td>
              <td>
               
              </td>
              <td>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
              </td>
            </tr>
            <?php $total = 0 ?>
       			@foreach( $users as $item)
				<tr>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->name_suffix }}</td>
              <td>{{ $item->user_code }}</td>
       				<td>{{ $item->user_refferal }}</td>
       				<td>{{ $item->registration_date }}</td>
       				<td>
              
              <span class="label label-info">{{ ($item->user_status == 1) ? 'active' :'unactive' }}</span> 
             
              </td>
              <td>{{ PriceHelper::formatPrice($item->register_fee) }}</td>
       				<td>
              <a href="{{ route('back.users.edit',$item->id) }}"><i class="fa fa-edit"></i> Edit</a>   <br>
              <a onclick="return confirm('Are you sure?')" href="{{ route('back.users.delete',$item->id) }}"><i class="fa fa-remove"></i> Delete</a>   <br>
               @if ($item->user_status == 0)
                <a href="{{ route('back.users.active',$item->id) }}" class="label label-success">Active User</a>
              @endif
              </td>
       			</tr>
            <?php $total += $item->register_fee ?>
       			@endforeach
            <tfoot>
              <tr>
                <td colspan="9">Total: <strong>{{ PriceHelper::formatPrice($total) }}</strong></td>
              </tr>
            </tfoot>
       		</table>
        </form>
        <div class="dataTables_paginate paging_simple_numbers">
          {!! $users->render() !!}
          <p class="">Showing {{$users->firstItem()}}/{{$users->lastItem()}} of {{$users->total()}} results</p>
        </div>

      </div><!-- /.box-body -->
      
    </div><!-- /.box -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('footer')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- date-range-picker -->
  <script src="{{ url('AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
  <script src="{{ url('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- DataTables -->
  <script src="{{ url('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script>

    //Date range picker
    $('.reservation').daterangepicker();
    $('#data-table').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
          "autoWidth": false
        });
  </script>
@endsection