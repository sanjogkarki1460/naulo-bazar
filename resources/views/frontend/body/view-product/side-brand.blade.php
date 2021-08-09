  <div class="card-body py-1 brand__filter ">
                                <form >
                                @foreach($brands as $key => $brand)
                                    <label><input class="uk-checkbox" type="checkbox" checked> {{$brand->title}}</label>
                                @endforeach
                                </form>
  </div>