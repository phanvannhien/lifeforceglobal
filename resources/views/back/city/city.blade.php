@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      City management
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">City management</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <div class="row">
      <div class="col-md-12">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">City</h3>
            </div>
            <div class="box-body">
              <table id="data-table" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                        <td>City Name</td>
                        <td>External Code</td>
                        <td>Action</td>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach( $cities as $city )
                    <tr>
                      <td>{{ $city->cityName }}</td>
                      <td>{{ $city->externalCode }}</td>
                     
                      <td>
                        <a href="{{ route('admin.city.edit',$city->id ) }}">
                          <i class="fa fa-edit"></i> Edit</a>
                         <a onclick="return confirm('Are you sure? You want delete this category');" href="{{ route('admin.city.destroy',$city->id) }}"><i class="fa fa-remove"></i> Delete</a>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>

              </table>
            </div>

          </div>
      </div>
    </div>

    
 </section>

@endsection

