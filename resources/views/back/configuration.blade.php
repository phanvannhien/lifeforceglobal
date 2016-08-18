@extends('back.master')
@section('content')

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     	Configurations
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">configuration</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Configurations</h3>
      </div>
      <div class="box-body">
		 <form action="{{ route('back.configuration.save')}}" method="post">
		 	<input type="hidden" value="{{ csrf_token() }}" name="_token">
		 	@foreach($configuration as $config )
				<div class="form-group">
					<label for="">{{ $config->label }}</label>
					{!! Site::renderConfig($config) !!}
				</div>
		 	@endforeach
		 	<button type="submit" class="btn btn-primary">Save</button>
		 </form>	
      </div>
    </div>
    </section>
</div>  

@endsection

@section('footer')
<link rel="stylesheet" href="{{ url('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<script src="{{ url('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
	<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //bootstrap WYSIHTML5 - text editor
        $("textarea").wysihtml5();
      });
    </script>
@endsection
