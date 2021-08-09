 <div class="tab-pane fade active show" id="nav-review" role="tabpanel"
                    aria-labelledby="nav-contact-tab">
                    @if(Auth::check())
                   @if(Auth::user()->productOrderUser($product->id)->count() > 0)
                <form action="{{route('comment.create')}}" method="post" class="review-form">
                    @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
               
                    <div class="" style="padding: 10px 0px;">
                        <span class="review--heading">Customer review</span>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5"><label class="full" for="star5"
                                title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4"><label class="full" for="star4"
                                title="Pretty good - 4 stars"></label>

                            <input type="radio" id="star3" name="rating" value="3"><label class="full" for="star3"
                                title="Meh - 3 stars"></label>

                            <input type="radio" id="star2" name="rating" value="2"><label class="full" for="star2"
                                title="Kinda bad - 2 stars"></label>

                            <input type="radio" id="star1" name="rating" value="1"><label class="full" for="star1"
                                title="Sucks big time - 1 star"></label>

                        </fieldset>
                        <div class="clearfix"></div>
                    </div>
                        <p class="comment">write something</p>
                        <textarea type="text" class="form-control" id="comment" name="review" placeholder="write something" rows="3"
                            cols="100"></textarea>
                        <button class="btn btn-primary " type="submit"> comment</button>
                        <div class="clearfix"></div>
                    
                    </form>
                    @endif
                  @endif
                    <div class="clearfix"></div>
                    <p class="review-user">{{number_format($product->getAverage(),1)}} average based on {{$product->countReview()}} reviews.</p>
                    <hr style="border:3px solid #f1f1f1; width:70%">
                    <div class="row review-rating">
                        @if($product->fetchReview())
                        @foreach($product->fetchReview() as $key => $value)
                        <div class="side">
                            <div>{{$loop->iteration}} star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                                {{-- {{dd($product->starAvg($value))}} --}}
                                <div class="bar-{{$loop->iteration}}"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>{{$value}}</div>
                        </div>
                        @endforeach
                        @else
                      
                            <div class="side">
                                <div>5 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-5"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>0</div>
                            </div>
                            <div class="side">
                                <div>4 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-4"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>0</div>
                            </div>
                            <div class="side">
                                <div>3 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-3"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>0</div>
                            </div>
                            <div class="side">
                                <div>2 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-2"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>0</div>
                            </div>
                            <div class="side">
                                <div>1 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-1"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>0</div>
                            </div>
                       
                        @endif
                    </div>
                    <div class="review-container">
                        <h3 class="review-title">Reviews</h3>
                          @if($product->comments)
                                    @foreach($product->comments as $key => $value)
                                        
                                            <article class="reviews" style="display: block;">
                                        <figure class="user-image">
                                            <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                alt="">
                                        </figure>
                                        <div class="review-right">
                                            <span class="username"> {{$value->user->name}}</span>&nbsp;<span
                                                class="published">{{$value->created_at}}</span>&nbsp;&nbsp;<span>
                                                    @for($i = 0; $i < $value->ratings ; $i++)
                                                    <i class="fas fa-star fa-xs"></i>
                                                    @endfor
                                                </span>
                                            <p>{{$value->review}}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                    @if($loop->last)
                                    <button class="btn show-more btn-primary center"> show more</button>
                                    @endif
                    
                        @endforeach
                            @else
                        <div class="review-right text-center">
                                <h5>No Reviews!!</h5>
                            </div>
                        @endif
                       

                        
                        <div class="clearfix"></div>

                    </div>
                </div>