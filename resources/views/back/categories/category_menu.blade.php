<a href="{{ route('back.categories.create') }}" class="btn btn-primary btn-block margin-bottom">Add new category</a>
<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Categories</h3>
    <div class="box-tools">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body no-padding" style="display: block;">
    <ul class="nav nav-pills nav-stacked">
      @foreach( \App\Models\Categories::all() as $item )
      <li><a href="{{ route('back.categories.edit',$item->id) }}"><i class="fa fa-envelope-o"></i> {{ $item->category_name }}</a></li>
      @endforeach
    </ul>
  </div><!-- /.box-body -->
</div>