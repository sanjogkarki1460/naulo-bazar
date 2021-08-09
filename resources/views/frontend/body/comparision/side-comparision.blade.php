<div class="navbar-collapse offcanvas-collapse-comparision">
            <button class="close-collapse btn btn-danger btn-sm  float-right">X</button>
            <div class="toolbar-section current" id="comparision">
                <div class="table-responsive shopping-cart mb-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <div class="d-flex justify-content-between align-items-center">Comparision<a
                                            class="nav-link text-capitalize btn-link" href="{{route('user.compare')}}"><span
                                                class="btn-link">Compare</span><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @if(session()->get('compare'))
                            @foreach(session()->get('compare')->items as $key => $value)
                            <tr>
                                <td>
                                    <div class="product-item"><a class="product-thumb" href="shop-single.html">
                                        
                                        <img src="{{asset('storage/products/'.$value['items']->slug.'/thumbs'.'/small_'.$value['items']->image)}}" alt="Product"></a>
                                        <div class="product-info">
                                        <h4 class="product-title"><a href="shop-single.html">{{$value['items']->title}}</a></h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><a class="remove-from-cart" href="#"><i
                                            class="fas fa-close"></i></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr class="mb-3">
   
            </div>
        </div>