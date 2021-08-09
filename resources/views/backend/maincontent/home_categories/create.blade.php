    <div class="text-center">
        <h4 class="badge badge-primary p-3 font-12 ">{{__('Home Categories')}}</h4>
    </div>
		
    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_categories.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="form-group" id="category">
				 <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-list" aria-hidden="true"></i>
 &nbsp;{{__('Category')}}</span>
                </div>
              
                    <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                        @foreach(\App\Category::all() as $category)
                            @if (\App\HomeCategory::where('category_id', $category->id)->first() == null)
                                <option value="{{$category->id}}">{{__($category->name)}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
        </div>
		</div>
        <div class="panel-footer text-right m-2">
            <button class="btn btn-outline-success" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>
