@extends('front.layouts.master')

@section('banner')
<div class="hero__item set-bg" data-setbg="{{ asset('assets/img/hero/banner.jpg') }}">
    <div class="hero__text">
        <span>FRUIT FRESH</span>
        <h2>Vegetable <br />100% Organic</h2>
        <p>Free Pickup and Delivery Available</p>
        <a href="#" class="primary-btn">SHOP NOW</a>
    </div>
</div>
@endsection

@section('content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    
                    @foreach($main_categories as $category)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset($category->getImage()) }}">
                            <h5><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach($featured_categories as $category)
                            <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                
                @foreach($featured_products as $product)

                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->category->slug }}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset($product->getThumbnail()) }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{ route('product', $product->slug) }}">{{ $product->title }}</a></h6>
                            <h5>${{ $product->getPrice() }}</h5>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                @foreach( $home_ads as $ad )
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        {!! $ad->link ? '<a target="_blank" href="'. $ad->link . '">' : ''  !!}
                            <img src="{{ asset($ad->getAdImage()) }}" alt="">
                        {!! $ad->link ? '</a>' : '' !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            
                            <div class="latest-prdouct__slider__item">
                                @for($i = 0; $i < $top_rated_products->count() / 2; $i++)
                                <a href="{{ route('product', $top_rated_products[$i]->slug) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($top_rated_products[$i]->getThumbnail()) }}" alt="{{ $top_rated_products[$i]->title }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $top_rated_products[$i]->title }}</h6>
                                        <span>${{ $top_rated_products[$i]->getPrice() }}</span>
                                    </div>
                                </a>
                                @endfor
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @for($i = $top_rated_products->count() / 2; $i < $top_rated_products->count(); $i++)
                                <a href="{{ route('product', $top_rated_products[$i]->slug) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($top_rated_products[$i]->getThumbnail()) }}" alt="{{ $top_rated_products[$i]->title }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $top_rated_products[$i]->title }}</h6>
                                        <span>${{ $top_rated_products[$i]->getPrice() }}</span>
                                    </div>
                                </a>
                                @endfor
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @for($i = 0; $i < $reviewed_products->count() / 2; $i++)
                                <a href="{{ route('product', $reviewed_products[$i]->slug) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($reviewed_products[$i]->getThumbnail()) }}" alt="{{ $reviewed_products[$i]->title }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $reviewed_products[$i]->title }}</h6>
                                        <span>${{ $reviewed_products[$i]->getPrice() }}</span>
                                    </div>
                                </a>
                                @endfor
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @for($i = $reviewed_products->count() / 2; $i < $reviewed_products->count(); $i++)
                                <a href="{{ route('product', $reviewed_products[$i]->slug) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($reviewed_products[$i]->getThumbnail()) }}" alt="{{ $reviewed_products[$i]->title }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $reviewed_products[$i]->title }}</h6>
                                        <span>${{ $reviewed_products[$i]->getPrice() }}</span>
                                    </div>
                                </a>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latest_posts as $post)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset($post->getThumbnail()) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> {{ $post->created_at->diffForHumans() }}</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a></h5>
                            <p>{{ $post->excerpt }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection