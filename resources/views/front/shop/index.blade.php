@extends('front.layouts.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach($categories_has_products as $sidebar_category)
                                <li><a 
                                onclick='
                                    event.preventDefault();
                                    let filters = [];
                                    filters["category"] = "{{ $sidebar_category->slug }}";
                                    appendParam(filters);
                                '
                                href="#">{{ $sidebar_category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="2" data-max="100"
                                    data-price-from="{{ $search_filters['price_from'] }}" data-price-to="{{ $search_filters['price_to'] }}">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>                    
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @for($i = 0; $i < $latest_products->count() / 2; $i++)
                                        <a href="{{ route('product', $latest_products[$i]->slug) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset($latest_products[$i]->getThumbnail()) }}" alt="{{ $latest_products[$i]->title }}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $latest_products[$i]->title }}</h6>
                                                <span>${{ $latest_products[$i]->getPrice() }}</span>
                                            </div>
                                        </a>
                                        @endfor
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        @for($i = $latest_products->count() / 2; $i < $latest_products->count(); $i++)
                                        <a href="{{ route('product', $latest_products[$i]->slug) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset($latest_products[$i]->getThumbnail()) }}" alt="{{ $latest_products[$i]->title }}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $latest_products[$i]->title }}</h6>
                                                <span>${{ $latest_products[$i]->getPrice() }}</span>
                                            </div>
                                        </a>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($top_discount_rated_products as $product)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset($product->getThumbnail()) }}">
                                            <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a 
                                                onclick="
                                                    event.preventDefault();
                                                    Cart.add('{{ $product->slug }}', 'wishlist');
                                                "
                                                href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a 
                                                onclick="
                                                    event.preventDefault();
                                                    Cart.add('{{ $product->slug }}');
                                                "
                                                href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{ $product->category->name }}</span>
                                            <h5><a href="{{ route('product', $product->slug) }}">{{ $product->title }}</a></h5>
                                            <div class="product__item__price">${{ $product->getPriceAfterDiscount() }} <span>${{ $product->getPrice() }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $products->count() }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset($product->getThumbnail()) }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a 
                                        onclick="
                                            event.preventDefault();
                                            Cart.add('{{ $product->slug }}', 'wishlist');
                                        "
                                        href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a 
                                        onclick="
                                            event.preventDefault();
                                            Cart.add('{{ $product->slug }}');
                                        "
                                        href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('product', $product->slug) }}">{{ $product->title }}</a></h6>
                                    <h5>${{ $product->getPrice() }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>

                    <div>
                        {{ $products->links() }}
                    </div>
                    <!-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection