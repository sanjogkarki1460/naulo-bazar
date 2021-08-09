@extends('frontend.body.body')
@section('body')
    <style>
        .page-link {
            color: red;
        }
    </style>
    <div class="container-fluid">
        <div>
            <img
                    src="https://zholaa.nextnepal.dev/storage/banners/images/1603116708.jpg"
                    alt=""
                    srcset=""
                    width="100%"
            />
        </div>
        <div class="row mt-4">
            <div class="col-4 text-center bg-grey pt-5 ">
                <div class="mt-5 ">
                    <div class="d-flex justify-content-center">
                        <img
                                class="img-fluid "
                                src="https://zholaa.nextnepal.dev/backend/assets/images/zholaa_logo.png"
                                alt=""
                                srcset=""
                                width="200"
                        />
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="https://zholaa.nextnepal.dev/vendors/follow/1">
                            <button class="btn btn-md bg-danger float-right mt-3 text-white ">
                                Follow
                            </button>
                        </a>
                    </div>
                </div>
                <div class="mt-5 ml-4 text-left">
                    <h5><span class="text-bold">Company:</span> Company Title</h5>
                    <h6>Other Details:.........</h6>
                </div>
            </div>
            <div class="col-8 bg-dark">
                <div class=" pt-4  mb-3">
                    <h4 class="text-white text-bold d-flex justify-content-center">
                        Product Categories
                    </h4>
                    <div class="dropdown d-flex justify-content-end">
                        <label for="filter" class="text-white mt-3 mr-3">Sort By</label>
                        <button
                                class="btn btn-secondary dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                        >
                            Filters
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Category1</a>
                            <a class="dropdown-item" href="#">Category2</a>
                            <a class="dropdown-item" href="#">Category3</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3 mt-2">
                            <img
                                    src="https://zholaa.nextnepal.dev/storage/products/test/thumbs/small_1601881558.jpeg"
                                    class="card-img-top"
                                    alt="..."
                                    width="100"
                                    height=""
                            />
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <a href="#" class="btn btn-secondary">See More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" style="color:red">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"
                            >Previous</a
                            >
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection