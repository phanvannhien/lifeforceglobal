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
              <textarea name="category_description" id="category_description" class="form-control textarea" cols="30" rows="10">{{ $category->category_description }}</textarea>
            </div>
            <div class="form-group">
              <label for="">Category Image</label>
              <div class="input-group">
                  <span class="input-group-btn">
                    <a id="lfm-category_image" data-input="category_image" data-preview="gallery-category_image" class="btn btn-primary gallery">
                      <i class="fa fa-picture-o"></i> Choose Image
                    </a>
                  </span>
                  <input id="category_image" value="{{ $category->category_image }}" class="form-control" type="text" name="category_image">

                </div>
              <img id="gallery-category_image" src="{{ $category->category_image }}" style="margin-top:15px;max-height:100px;">


            </div>
             <div class="form-group">
              <label for="">Image Position</label>
              <select name="image_position" id="" class="form-control">
                <option {{ ($category->image_position == 'left') ? 'selected': '' }} value="left">Left</option>
                <option {{ ($category->image_position == 'right') ? 'selected': '' }} value="right">Right</option>
              </select>
            </div>
             <div class="form-group">
              <label for="">Category Background</label>
              <input value="{{$category->category_color}}" name="category_color" id="category_color" class="form-control colorpicker">
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

@section('footer')
<!-- CK Editor -->
<script src="/AdminLTE/plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">
<!-- bootstrap color picker -->
<script src="/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="{{ url('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  var editor = CKEDITOR.replace('category_description');
  editor.config.allowedContent = true;
  editor.config.extraPlugins = 'font';
    //Colorpicker
  $(".colorpicker").colorpicker();
  $('.gallery').filemanager('image');
  //bootstrap WYSIHTML5 - text editor
  //$(".textarea").wysihtml5();
  });
</script>
@endsection



