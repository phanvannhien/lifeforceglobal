@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Categories management
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Categories management</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <div class="row">
      <div class="col-md-3">
        @include('back.categories.category_menu')
      </div>
      <div class="col-md-9">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Categories</h3>
            </div>
            <div class="box-body">
              <table id="data-table" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                        <td>ID</td>
                        <td>Category Name</td>
                        <td>Status</td>
                        <td>Number of Products</td>
                        <td>Action</td>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach( $categories as $item )
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->category_name }}</td>
                      <td><span class="label label-info">{{ ($item->category_status == 1) ? 'actived' : 'deactivated' }}</span> </td>
                      <td>
                        {{ $item->product()->count() }}
                      </td>
                      <td>
                        <a href="{{ route('back.categories.edit',$item->id) }}"><i class="fa fa-edit"></i> Edit</a>
                         <a onclick="return confirm('Are you sure? You want delete this category');" href="{{ route('back.categories.delete',$item->id) }}"><i class="fa fa-remove"></i> Delete</a>

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

