 <div class="card-body py-1">
                                <div class="scrollbar ">
                                    <ul>

                                    @foreach($othercategories as $key => $othercategory)

                                           <li class="category-list"><a class="link-category" href="{{route('category.products',$othercategory->id)}}">{{$othercategory->title}}
                                            </a></li>
                                    @endforeach
                                    </ul>
                                </div>
                             </div>