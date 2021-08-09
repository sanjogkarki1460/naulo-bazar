<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>zholaa|Ecommerce</title>
    <!-- Bootstrap CSS -->

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- owl css -->
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.min.css">

    <link rel="stylesheet" href="https://unpkg.com/xzoom/dist/xzoom.css">

    <!-- font family -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- custom scroll bar -->
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.mCustomScrollbar.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/toastr/toastr.min.css') }}">
    <link type="text/css" href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet" media="all">



</head>

<body onload="myloader()">


@yield('content')
<div id="preloaders" class="preloader"></div>
@include('frontend.footer.footer')
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 copyfont">
                Copyright © All rights reserved. Powerd by
                <span style="color: red; cursor: pointer;">Next Nepal</span>
            </div>
            <div class="col-lg-6 text-right payMethod">
                <img src="{{asset('frontend/images/logo/esewa.png')}}"/>
                <img src="{{asset('frontend/images/logo/nPay.png')}}"/>
                <img src="{{asset('frontend/images/logo/master_card.png')}}"/>
                <img src="{{asset('frontend/images/logo/visa.png')}}"/>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!-- Owl carousel -->
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<!-- metis menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.js"></script>
<script src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>

<!-- custom scroll -->


<script src="{{asset('frontend/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{asset('frontend/js/xzoom.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{asset('frontend/js/app.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>

<script src="{{ asset('backend/assets/vendor/toastr/toastr.min.js') }}"></script>
<script>

    function myloader() {
        document.getElementById("preloaders").style.display = 'none';
    }


</script>

@stack('scripts')
@if (session('status'))
    <script>
        $(function () {
            toastr.success("{{ session('status') }}");
        });

    </script>
@endif
@if (session('error'))
    <script>
        $(function () {
            toastr.error("{{ session('error') }}");
        });

    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $key=>$error)
        <script>
            $(function () {
                toastr.error("{{ $error }}");
            });

        </script>
    @endforeach
@endif
<script>

    $(document).ready(function () {
        $(".alert-success").delay(5000).slideUp(300);
    });
    $(document).ready(function () {
        $(".alert-danger").delay(5000).slideUp(300);
    });
    $(document).ready(function () {
        $(function () {
            autocomplete('#searchTextLg', {}, [{
                source: function (request, response) {
                    $.ajax({
                        url: "{{ url('/autoCategory') }}",
                        data: {query: $("#searchTextLg").val(), category: $('#searchParaLg').val()},
                        dataType: "json",
                        type: "GET",
                        success: function (data) {
                            console.log(data);
                            response($.map(data, function (obj) {
                                return {
                                    count: obj.count,
                                    productname: obj.productname,
                                    catname: obj.catname,
                                    catid: obj.catid,
                                    slug: obj.catslug,
                                    query: obj.query,
                                };
                            }));
                        }
                    });
                },

                displayKey: 'name',
                templates: {
                    header: '<div class="aa-suggestions-category"> <span class="title text-center"><i class="fa fa-table"></i> CATEGORIES </span> </div>',
                    suggestion: function (suggestion) {
                        var a = suggestion.count, result = 'result';
                        if (a > 1) {
                            result = 'results';
                        }
                        return '<a href="{{ url('/') }}/search?cat=' + suggestion.catid + '&query=' + suggestion.query + '">' +
                            '<span class="search-cat">' +
                            '<span class="searchTerm">' + suggestion.query + '</span> ' +
                            '<span class="searchCategory"><span class="in"> in</span><em>' + suggestion.catname + '</em></span>' +
                            '</span>' +
                            ' <span class="total">' +
                            '<span class="count">(' + suggestion.count + ')</span>' +
                            '<span class="result">' + result + '</span>' +
                            '</span>' +
                            '</a>';
                    }
                }
            },
                {
                    source: function (request, response) {
                        $.ajax({
                            url: "{{ url('/autoComplete') }}",
                            data: {query: $("#searchTextLg").val(), category: $('#searchParaLg').val()},
                            dataType: "json",
                            type: "GET",
                            success: function (data) {
                                response($.map(data, function (obj) {
                                    return {
                                        name: obj.name,
                                        slug: obj.slug,
                                        path: obj.path,
                                        id: obj.id,
                                        price: obj.product_price,
                                        // description: obj.short_description,
                                    };
                                }));
                            }
                        });
                    },
                    displayKey: 'name',
                    templates: {
                        header: '<div class="aa-suggestions-category"><span class="title text-center"><i class="fa fa-shopping-bag"></i> PRODUCTS</span></div>',
                        suggestion: function (suggestion) {
                            return '<div>' + '<a href="{{ url('/') }}/product/' + suggestion.slug + '">' + '' +
                                '<span class="product-image">' +
                                '       <img class="suggest-image" src="' + suggestion.path + '"  data-placeholder="" alt="' + suggestion.name + '">' +
                                '</span>' +
                                '<span class="product-details">' +
                                '<span class="product-title">' +
                                '<span><em>' + suggestion.name + '</em></span>' +
                                // '<span>' + suggestion.description + '</span>' +
                                '</span>' +
                                '<span class="product-price"> Rs: ' + suggestion.price.toLocaleString() + '</span>' +
                                '</span>' +
                                '</a>' +
                                '</div>';
                        }
                    }
                }
            ]);

            autocomplete('#searchTextSm', {}, [{
                source: function (request, response) {
                    $.ajax({
                        url: "{{ url('/autoCategory') }}",
                        data: {query: $("#searchTextSm").val(), category: $('#searchParaSm').val()},
                        dataType: "json",
                        type: "GET",
                        success: function (data) {
                            response($.map(data, function (obj) {
                                return {
                                    count: obj.count,
                                    productname: obj.productname,
                                    catname: obj.catname,
                                    catid: obj.catid,
                                    slug: obj.catslug,
                                    query: obj.query,
                                };
                            }));
                        }
                    });
                },

                displayKey: 'name',
                templates: {
                    header: '<div class="aa-suggestions-category"> <span class="title text-center"><i class="fa fa-table"></i> CATEGORIES </span> </div>',
                    suggestion: function (suggestion) {
                        var a = suggestion.count, result = 'result';
                        if (a > 1) {
                            result = 'results';
                        }
                        return '<a href="{{ url('/') }}/search?cat=' + suggestion.catid + '&query=' + suggestion.query + '">' +
                            '<span class="search-cat">' +
                            '<span class="searchTerm">' + suggestion.query + '</span> ' +
                            '<span class="searchCategory"><span class="in"> in</span><em>' + suggestion.catname + '</em></span>' +
                            '</span>' +
                            ' <span class="total">' +
                            '<span class="count">(' + suggestion.count + ')</span>' +
                            '<span class="result">' + result + '</span>' +
                            '</span>' +
                            '</a>';
                    }
                }
            },
                {
                    source: function (request, response) {
                        $.ajax({
                            url: "{{ url('/autoComplete') }}",
                            data: {query: $("#searchTextSm").val(), category: $('#searchParaSm').val()},
                            dataType: "json",
                            type: "GET",
                            success: function (data) {
                                response($.map(data, function (obj) {
                                    return {
                                        name: obj.name,
                                        slug: obj.slug,
                                        path: obj.path,
                                        id: obj.id,
                                        price: obj.product_price,
                                        description: obj.short_description,
                                    };
                                }));
                            }
                        });
                    },
                    displayKey: 'name',
                    templates: {
                        header: '<div class="aa-suggestions-category"><span class="title text-center"><i class="fa fa-shopping-bag"></i> PRODUCTS</span></div>',
                        suggestion: function (suggestion) {
                            return '<div>' + '<a href="{{ url('/') }}/product/' + suggestion.slug + '">' + '' +
                                '<span class="product-image">' +
                                '       <img class="suggest-image" src="' + suggestion.path + '"  data-placeholder="" alt="' + suggestion.name + '">' +
                                '</span>' +
                                '<span class="product-details">' +
                                '<span class="product-title">' +
                                '<span><em>' + suggestion.name + '</em></span>' +
                                '<span>' + suggestion.description + '</span>' +
                                '</span>' +
                                '<span class="product-price"> Rs: ' + suggestion.price.toLocaleString() + '</span>' +
                                '</span>' +
                                '</a>' +
                                '</div>';
                        }
                    }
                }
            ]);

        });
    });


</script>
</body>

</html>
