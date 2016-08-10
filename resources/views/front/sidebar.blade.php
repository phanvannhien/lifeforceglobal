<div class="panel-group" id="accordionNo">
   <div class="panel panel-default">
      <div id="collapseCategory" class="panel-collapse collapse in">
         <div class="panel-body">
            <ul class="nav nav-pills nav-stacked tree">
               <li class="active dropdown-tree open-tree">
                @foreach (Site::NavData() as $category )
               <li><a href="{{ route('front.category', array($category->id, Str::slug($category->category_name)) ) }}"> {{ $category->category_name }} </a></li>
               @endforeach
           
            </ul>
         </div>
      </div>
   </div>
</div>