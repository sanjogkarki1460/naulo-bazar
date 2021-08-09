    <!-- Banner -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          @foreach($banners as $value)
          @if($value->page =='home' && $value->position == 'top')
          <div class="carousel-item @if($loop->first) active  @endif">
             <img src="{{asset('storage/banners/images'.'/'.$value->image)}}" class="d-block w-100" alt="...">
          </div>
          @endif
           @endforeach
          {{-- <div class="carousel-item">
            <img src="{{asset('frontend/images/banner/2.jpg')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{asset('frontend/images/banner/3.jpg')}}" class="d-block w-100" alt="...">
          </div> --}}
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    <!-- Banner -->
    <!--Single Image -->
    <div class="container">
        <div class="img-for-promo">
              @foreach($banners as $key => $value)
              @if($value->page == 'home' && $value->position == 'middle' && $value->type == 'horizontal')
             
                    <figure><img src="{{asset('storage/banners/images'.'/'.$value->image)}}" alt=""></figure>
            
                @endif
            @endforeach
        </div>
    </div>
    <!--Featured Image -->
    <div class="promo-2-section pb-5">
        <div class="container">

            <div class="row">
            @foreach($banners as $key => $value)
              @if($value->page == 'home' && $value->position == 'bottom' && $value->type == 'box')
              <div class="col-md-4">
                    <figure><img src="{{asset('storage/banners/images'.'/'.$value->image)}}" alt=""></figure>

                </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>

     @include('frontend.body.home.deals')
     <!-- Bottom Banner -->
    <div class="container">
        <div class="img-for-promo">
                @foreach($banners as $key => $value)
                @if($value->page == 'home' && $value->position == 'bottom' && $value->type == 'horizontal')
                      <figure><img src="{{asset('storage/banners/images'.'/'.$value->image)}}" alt=""></figure>
                  @endif
            @endforeach
        </div>
    </div>