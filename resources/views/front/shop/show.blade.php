@extends('front.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->title }}</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="{{ route('category', $product->category->slug) }}">{{ $product->category->name }}</a>
                            <span>{{ $product->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ $product->getThumbnail() }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach($product->images as $image)
                            <img data-imgbigurl="{{ asset('assets/img/' . $image->path) }}"
                                src="{{ asset('assets/img/' . $image->path) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->title }}</h3>
                        <div class="product__details__rating">

                            <i class="fa {{ $product_rate >= 10 && $product_rate < 20 ? 'fa-star-half-o' : '' }} {{ $product_rate >= 20 ? 'fa-star' : 'fa-star-o' }}"></i>
                            <i class="fa {{ $product_rate >= 30 && $product_rate < 40 ? 'fa-star-half-o' : '' }} {{ $product_rate >= 40 ? 'fa-star' : 'fa-star-o' }}"></i>
                            <i class="fa {{ $product_rate >= 50 && $product_rate < 60 ? 'fa-star-half-o' : '' }} {{ $product_rate >= 60 ? 'fa-star' : 'fa-star-o' }}"></i>
                            <i class="fa {{ $product_rate >= 70 && $product_rate < 80 ? 'fa-star-half-o' : '' }} {{ $product_rate >= 80 ? 'fa-star' : 'fa-star-o' }}"></i>
                            <i class="fa {{ $product_rate >= 90 && $product_rate < 100 ? 'fa-star-half-o' : '' }} {{ $product_rate >= 100 ? 'fa-star' : 'fa-star-o' }}"></i>

                            <span>({{ $reviews_number }} reviews)</span>
                        </div>
                        <div class="product__details__price">${{ $product->getPriceAfterDiscount() }}</div>
                        <p>{{ $product->small_description }}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="product_qty" type="number" min="1" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn add_to_cart_btn">ADD TO CART</a>
                        <a href="#" class="heart-icon add_to_wishlist_btn"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>{{ $product->inStock() ? 'In Stock' : 'Not Available in Stock'}}</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($recommended_products as $recommended_product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ $recommended_product->getThumbnail() }}">
                            <ul class="product__item__pic__hover">
                                <li><a 
                                onclick="
                                    event.preventDefault();
                                    Cart.add('{{ $recommended_product->slug }}', 'wishlist');
                                "
                                href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a 
                                onclick="
                                    event.preventDefault();
                                    Cart.add('{{ $recommended_product->slug }}');
                                "
                                href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('product', $recommended_product->slug) }}">{{ $recommended_product->title }}</a></h6>
                            <h5>${{ $recommended_product->getPriceAfterDiscount() }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection

@section('scripts')
<script>
    $(document).on("click", ".add_to_cart_btn, .add_to_wishlist_btn", (e) => {
        let cart_type = '';
        if($(e.target).hasClass("add_to_cart_btn")){
            cart_type = 'default';
        } else {
            cart_type = 'wishlist';
        }
        e.preventDefault();
        let qty = $("input[name='product_qty']").val();
        let slug = "{{ $product->slug }}";
        if(qty > 0) {
            Cart.add(slug, cart_type, qty);
        }
    });
</script>
@endsection