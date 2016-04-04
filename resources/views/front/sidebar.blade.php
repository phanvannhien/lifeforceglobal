<div class="panel-group" id="accordionNo">
   <div class="panel panel-default">
      <div class="panel-heading">
         <h4 class="panel-title"><a data-toggle="collapse" href="#collapseCategory" class="collapseWill active ">
            <span class="pull-left"> <i class="fa fa-caret-right"></i></span> Category </a>
         </h4>
      </div>
      <div id="collapseCategory" class="panel-collapse collapse in">
         <div class="panel-body">
            <ul class="nav nav-pills nav-stacked tree">
               <li class="active dropdown-tree open-tree">
                @foreach (Site::NavData() as $category )
               <li><a href="{{ route('front.category',$category->id) }}"> {{ $category->category_name }} </a></li>
               @endforeach
           
            </ul>
         </div>
      </div>
   </div>
</div>