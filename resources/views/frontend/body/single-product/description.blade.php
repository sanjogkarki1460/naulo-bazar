    <section id="product-description">

        <div class="container">
            <nav class="product-desc-tabs">
                <ul class="nav nav-tabs" id="nav-tab">

                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-home">Description</a></li>
                    <li class="nav-item"><a class="nav-item nav-link" data-toggle="tab"
                            href="#nav-Addtional-features">Additional
                            Info</a></li>
                    <li class="nav-item"><a class="nav-item nav-link active show" data-toggle="tab"
                            href="#nav-review">Reviews</a>
                    </li>
                </ul>
            </nav>
            <div class="tab-content product-desc-details" id="nav-tabContent">
                <div class="tab-pane" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <ul class="product-desc-list">
                    {!! $product->long_content !!}
                   
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-Addtional-features" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    <h3>More Info</h3>
                    <p>{!! $product->short_content !!}
                    </p>
                </div>
{{--               @include('frontend.body.single-product.review')--}}
            </div>
        </div>

    </section> 
