  <div class="text-center">
        <h4 class="badge badge-primary p-3 font-12 ">{{__('Home Categories')}}</h4>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_categories.update', $homeCategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
		
            <div class="form-group" id="category">
				 <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-list" aria-hidden="true"></i>
 &nbsp;{{__('Category')}}</span>
                </div>
					 
      
                    <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                        @foreach(\App\Category::all() as $category)
                            <option value="{{$category->id}}" @php if($homeCategory->category_id == $category->id) echo "selected"; @endphp>{{__($category->name)}}</option>
                        @endforeach
                    </select>
                </div>
            
     
        <div class="panel-footer text-right m-2">
            <button class="btn btn-success" type="submit">{{__('Save')}}</button>
        </div>
		</div>
				</form>
	
    <!--===================================================-->
    <!--End Horizontal Form-->


