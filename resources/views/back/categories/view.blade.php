@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All Categories
      <a href="{{ route('back.categories.create') }}" class="btn btn-success">Create New</a>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Categories</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('back.message')
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
                  <a href="{{ route('back.categories.edit',$item->id) }}"><i class="fa fa-edit"></i> Edit</a>

                </td>
              </tr>
              @endforeach
            </tbody>

        </table>
      </div>

    </div>
 </section>

@endsection

