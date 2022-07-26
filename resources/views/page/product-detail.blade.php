@extends('client.client-master')
@section('title', $product->name)
@section('content-client')
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-7 pb-2">
                <style>
                    .lSSlideOuter .lSPager.lSGallery li.active,
                    .lSSlideOuter .lSPager.lSGallery li:hover {
                        border-radius: 0px;
                        border: 1px solid;
                    }
                </style>
                <ul id="imageGallery">
                    @foreach ($images as $image)
                        <li data-thumb="{{ asset('/images/products/' . $image->gallery) }}"
                            data-src="{{ asset('/images/products/' . $image->gallery) }}">

                            <img width="820" alt="{{ $product->name }}"
                                src="{{ asset('/images/products/' . $image->gallery) }}" />
                        </li>
                    @endforeach








                </ul>
            </div>

            <div class="col-lg-5 pb-5">
                <h1 class="font-weight-semi-bold">{{ $product->name }}</h1>
                <div class="d-flex mb-3">
                    
                    <small class="pt-1"> Đã bán {{ $orders->count() }}</small>
                </div>
                <h1>{{ number_format($product->price_new, 0, ',', '.') . ' VNĐ' }}</h1>
                <h2 class="text-muted ml-2"><del
                        style="color: red">{{ number_format($product->price_old, 0, ',', '.') . ' VNĐ' }}</del></h2>

                <p class="mb-4">
                    {{ $product->description }}</p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    {{-- for each ra id của cate --}}
                    {{-- ->id ra của cate data-filter=[cate->id] --}}
                    <form>
                        for
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                            {{-- for each ra id của product --}}
                            {{-- ->id ra của product data-filter=[product->id] --}}
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div>
                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-1" name="color">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-2" name="color">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-3" name="color">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-4" name="color">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-5" name="color">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                    </form>
                </div>



                <form action="{{ route('add-cart') }}" method="post">
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <input type="text" name="num_product" class="form-control bg-secondary text-center"
                                value="1">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @csrf
                        <button type="submit" class="btn btn-primary px-3">
                            <i class="fa fa-shopping-cart mr-1"></i>
                            Add To Cart
                        </button>
                        
                    </div>
                </form>
                {{--  gửi lên serve số lượng và id sản phẩm --}}


                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1" id="logout">

                    <div class="comment-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li>
                                <a href="#comments-logout" role="tab" data-toggle="tab">
                                    <h4 class="reviews text-capitalize">Comments</h4>
                                </a>
                            </li>
                            <li>
                                <a href="#add-comment" role="tab" data-toggle="tab">
                                    <h4 class="reviews text-capitalize">Add comment</h4>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            {{-- @if (Auth::user()) --}}
                            <div class="tab-pane active" id="comments-logout">
                                @foreach ($comments as $item)
                                    <ul class="media-list">
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object img-circle" viewBox="0 0 30 30" width="40"
                                                    height="40" src="{{ asset($item->users->avatar) }}"
                                                    alt="profile">
                                            </a>
                                            <div class="media-body">
                                                <div class="well well-lg">
                                                    <h4 class="media-heading text-uppercase reviews">
                                                        {{ $item->users->name }} </h4>
                                                    <ul class="media-date text-uppercase reviews list-inline">
                                                        <li class="dd">{{ $item->created_at }}</li>

                                                    </ul>
                                                    <p class="media-comment">
                                                        {{ $item->content }}
                                                    </p>
                                                </div>
                                                <ul>
                                                    <div class="row">
                                                        <div class="col-md-0">
                                                            <a class="btn btn-info btn-circle text-uppercase"
                                                                href="#" id="reply"><span
                                                                    class="glyphicon glyphicon-share-alt"></span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <div class="">
                                                                @if (Auth::user())
                                                                    <form action="{{ route('repcmt', $item->id) }}"
                                                                        method="post" class="form-horizontal"
                                                                        id="commentForm" role="form">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="product_id"
                                                                                value="{{ $product->id }}"
                                                                                id="">
                                                                            <div class="col-sm-9">
                                                                                <textarea class="form-control" name="content" id="addComment" placeholder="Repcoments" rows="3  "></textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <div class="col-sm-2">
                                                                                <button
                                                                                    class="btn btn-success btn-circle text-uppercase"
                                                                                    type="submit"
                                                                                    id="submitComment"><span
                                                                                        class="glyphicon glyphicon-send"></span>
                                                                                    Gửi</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                @else
                                                                    <div class="tab-pane" id="add-comment">
                                                                        <a href="{{ route('login') }}">
                                                                            <button
                                                                                class="btn btn-danger btn-circle text-uppercase">Bạn
                                                                                cần đăng
                                                                                nhập</button>
                                                                        </a>

                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                                <ul>
                                                    <div class="row">
                                                        @foreach ($rep as $item)
                                                            <div class="col-md-12">
                                                                <div class="well well-sm">
                                                                    <a class="pull-left" href="#">
                                                                        <img class="media-object img-circle"
                                                                            viewBox="0 0 30 3" width="40"
                                                                            height="40"
                                                                            src="{{ asset($item->users->avatar) }}"
                                                                            alt="profile">
                                                                    </a>
                                                                    <div class="media-body">
                                                                        <div class="">
                                                                            <h4
                                                                                class="media-heading text-uppercase reviews">
                                                                                {{ $item->users->name }} </h4>
                                                                            <ul
                                                                                class="media-date text-uppercase reviews list-inline">
                                                                                <li class="dd">{{ $item->created_at }}
                                                                                </li>
                                                                            </ul>
                                                                            <p class="media-comment">
                                                                                {{ $item->content }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </ul>
                                            </div>

                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                            {{-- @endif --}}
                            <br>

                            <div class="tab-pane" id="add-comment">
                                @if (Auth::user())
                                    <form action="{{ route('comments', $product->id) }}" method="post"
                                        class="form-horizontal" id="commentForm" role="form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Comment</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="content" id="addComment" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button class="btn btn-success btn-circle text-uppercase" type="submit"
                                                    id="submitComment"><span class="glyphicon glyphicon-send"></span>
                                                    Summit
                                                    comment</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="tab-pane" id="add-comment">
                                        <a href="{{ route('login') }}">
                                            <button class="btn btn-danger btn-circle text-uppercase">Bạn cần đăng
                                                nhập</button>
                                        </a>
                                    </div>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- danh sách sản phẩm --}}


    </div>
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg pb-2">

            </div>
            <div class="col-lg-11 pb-2">
                <center>
                    <h1>CÓ THỂ BẠN CŨNG BIẾT</h1>
                </center>
                <br>
                {{-- @dd($products); --}}
                @foreach ($products as $item)
                    <div data-filter="[{{ $item->id }}]" class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{ asset($item->image) }}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 style="font-size: 110%" class="text-truncate mb-3">{{ $item->name }}</h6>
                                <div class="d-flex justify-content-center">
                                    <h5>{{ number_format($item->price_new, 0, ',', '.') }}</h5>
                                    <h5 class="text-muted ml-2"><del
                                            style="color: red">{{ number_format($item->price_old, 0, ',', '.') }}</del>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a style="font-size: 80%" href="{{ route('detail', $item->id) }}"
                                    class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                    Detail</a>
                                <a style="font-size: 80%" href="" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-shopping-cart text-primary mr-1"></i>
                                    Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-lg" pb-2">

            </div>
        </div>
    </div>
@endsection
