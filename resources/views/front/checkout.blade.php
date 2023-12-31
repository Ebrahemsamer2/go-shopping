@extends('front.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('storage/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                        <div class='alert alert-danger'>{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form method="POST" action="{{ route('checkout.handle_payment') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name='firstname' required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name='lastname' required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name='country' required>
                            </div>
                            
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name='city' required>
                            </div>

                            <div class="checkout__input">
                                <p>Address line 1<span>*</span></p>
                                <input type="text" placeholder='Address Line 1' name='address_line_1' required>
                            </div>

                            <div class="checkout__input">
                                <p>Address line 2</p>
                                <input type="text" placeholder='Address Line 2' name='address_line_2'>
                            </div>

                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name='zipcode' required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name='phone' type="text" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name='email' required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                    
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input type="text" name='notes'
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>

                            <hr>

                            <a href='#shipToAnotherAddress' data-toggle='collapse' aria-expanded='false' aria-controls='shipToAnotherAddress'>
                                <h4>
                                    Ship to another address
                                </h4>
                            </a>

                            <div class="collapse" id='shipToAnotherAddress'>
                                <div class="checkout__input">
                                    <p>Ship Address line 1</p>
                                    <input type="text" placeholder='Ship Address Line 1' name='ship_address_line_1'>
                                </div>

                                <div class="checkout__input">
                                    <p>Ship Address line 2</p>
                                    <input type="text" placeholder='Ship Address Line 2' name='ship_address_line_2'>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                @foreach( $cart_products as $product )
                                    <li>{{$product->model->title}} <span>{{ $product->qty }} x ${{ $product->model->getPriceAfterDiscount() }}</span></li>
                                @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">
                                    Subtotal 
                                    <span>
                                        ${{ number_format( ( (int) \Cart::instance('default')->subtotal(0,'','') ) / 100 , 2, ',', ',') }}
                                    </span>
                                </div>
                                <div class="checkout__order__tax">
                                    Tax 
                                    <span>
                                        ${{ number_format( ( (int) \Cart::tax(0,'','') ) / 100 , 2, ',', ',') }}
                                    </span>
                                </div>
                                <div class="checkout__order__total">Total 
                                    <span>
                                        ${{ number_format( ( (int) \Cart::instance('default')->total(0,'','') ) / 100 , 2, ',', ',') }}
                                    </span>
                                </div>

                                <div class="checkout__input__checkbox">
                                    <label for="stripe">
                                        Stripe
                                        <input type="radio" checked id="stripe" name="payment_method" value="stripe">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="radio" id="paypal" name="payment_method" value="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    @endsection