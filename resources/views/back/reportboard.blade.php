@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Report
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Report</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Report WM commission</h3>
      </div>
      <div class="box-body">
        <form action="{{route('back.report')}}" class="form-horizontal" method="get">
          <input type="hidden" value="{{ csrf_token() }}" name="_token">
          <table id="" class="table table-bordered table-hover">
            <tbody>
              <tr>
                <td>
                  <input value="{{Input::get('report_date')}}" type="text" name="report_date" class="form-control reservation" placeholder="From Date-To Date">
                </td>
                <td colspan="5">
                  <button type="submit" name="submit" class="btn btn-info">Report</button>
                </td>
              </tr>
              <tr>
                <td><input value="{{Input::get('filter')['name']}}" type="text" name="filter[name]" class="form-control" placeholder="Name"></td>
                <td><input value="{{Input::get('filter')['email']}}" type="email" name="filter[email]" class="form-control" placeholder="Email"></td>
                <td><input value="{{Input::get('filter')['user_code']}}" type="text" size="12" name="filter[user_code]" class="form-control" placeholder="User Code"></td>
                <td><input value="{{Input::get('filter')['user_refferal']}}" type="text" size="12"  name="filter[user_refferal]" class="form-control" placeholder="User Referal Code"></td>
                 <td><input placeholder="Member Code" type="text" name="filter[membership_number]" value="{{Input::get('filter')['membership_number']}}" class="form-control"></td>
                <td>
                  <input value="{{Input::get('filter')['registration_date']}}" type="text" size="8" name="filter[registration_date]" class="form-control reservation" placeholder="From Date-To Date"><br>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
          <div class="clearfix">
            <p class="pull-right"> Showing <strong></strong> orders </p>
          </div>
       		<table id="data-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <td>Name</td>
                <td>Email</td>
                <td>UserCode</td>
                <td>UserReferal</td>
                <td>MemberCode</td>
                <td>RegistrationDate</td>
                <td>Total</td>
                <td>Commission (10%)</td>
              </tr>
            </thead>
            <tbody>
            @if( isset( $users) && count($users) > 0 )
              @foreach ($users as $u)
              <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->user_code }}</td>
                <td>{{ $u->user_refferal }}</td>
                <td>{{ $u->membership_number }}</td>
                <td>{{ $u->registration_date }}</td>
                <td>{{ PriceHelper::formatPrice($u->totals) }}</td>
                <td>{{ PriceHelper::formatPrice($u->commission) }}</td>
              </tr>

              @endforeach
            @else
              <tr>
                <td colspan="7"> No data </td>
              </tr>
            @endif  
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" align="right">Total: <strong></strong></td>
                </tr>
            </tfoot>
       		</table>
        <div class="dataTables_paginate paging_simple_numbers">
          @if( isset( $users) && count($users) > 0 )
          {!! $users->render() !!}
          <p class="">Showing {{$users->firstItem()}}/{{$users->lastItem()}} of {{$users->total()}} results</p>
          @endif
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
    $('.reservation').daterangepicker( {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 2 Month' : [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 3 Month' : [moment().subtract(4, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          //$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
  
    $('#data-table').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
          "autoWidth": true
        });
  </script>
@endsection