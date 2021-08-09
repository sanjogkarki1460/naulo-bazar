
    <div class="col-md-5 col-sm-6">
                            <div class="d-flex  align-items-center">
                                <div class="menu">
                                    <span id="toggle_dd" class="position-relative">
                                        <i class="fas fa-bars"></i> &nbsp;
                                        <span>All Category</span>
                                    </span>
                                    <div class="main_dropdown" style="display:none !important">
                                        <ul class="menu-items">
                                            <!-- submenus -->
                                            @foreach($categories as $key => $category)
                                                   <li class="menu-items--item"><a href="{{route('category.products',$category->id)}}">{{$category->title}}@if($category->subCategory->isNotEmpty())<i class="fa fa-chevron-right fa-1x"></i>@endif</a>
                                                <!-- first submenus -->
                                                @foreach($category->subCategory as $subcategory)
                                                          <ul class="menu-items sub-menus-1">
                                                    <li class="menu-items--item sub-menus-1-list"><a
                                                            href="{{route('category.products',$subcategory)}}">{{$subcategory->title}}@if($category->subCategory->isNotEmpty())<i class="fa fa-chevron-right fa-1x"></i>@endif</a>

                                                        <!-- second submenus -->
                                                        @foreach($subcategory->subCategory as $lastCategory)
                                                             <ul class="menu-items sub-menus-2">
                                                            <li class="menu-items--item sub-menus-2-list"><a
                                                                    href="{{route('category.products',$lastCategory->id)}}">{{$lastCategory->title}}</a>
                                                            </li>
                                                        </ul>   
                                                        @endforeach
                                                        
                                                    </li>
                                                </ul> 
                                                @endforeach
                                             
                                            </li>  
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="company-logo" style="display: none">
                                    <a href="">
                                        <figure><img src="{{asset('frontend/images/logo.png')}}" alt=""></figure>
                                    </a>
                                </div>
                            </div>
                        </div>