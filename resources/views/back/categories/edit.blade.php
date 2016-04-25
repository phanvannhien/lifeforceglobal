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
          <form action="{{ route('back.categories.update',$category->id) }}" method="post">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <input type="hidden" value="{{ $category->id}}" name="id">
            <div class="form-group">
              <label for="">Category Name</label>
              <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
            </div>
            <div class="form-group">
              <label for="">Category Description</label>
              <textarea name="category_description" id="" class="form-control textarea" cols="30" rows="10">{{ $category->category_description }}</textarea>
            </div>
            <div class="form-group">
              <label for="">Category Status</label>
              <select name="category_status" class="form-control" id="">
                <option {{ ($category->category_status == 1) ? 'selected' :'' }} value="1">Activated</option>
                <option {{ ($category->category_status == 0) ? 'selected' :'' }} value="0">Deactivated</option>
              </select>
            </div>  
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>

    </div>
 </section>

@endsection

