@extends('front.layouts.master')

@section('styles')
<style>
    @media (min-width: 1025px) {
    .h-custom {
    height: 100vh !important;
    }
    }

    .horizontal-timeline .items {
    border-top: 2px solid #ddd;
    }

    .horizontal-timeline .items .items-list {
    position: relative;
    margin-right: 0;
    }

    .horizontal-timeline .items .items-list:before {
    content: "";
    position: absolute;
    height: 8px;
    width: 8px;
    border-radius: 50%;
    background-color: #ddd;
    top: 0;
    margin-top: -5px;
    }

    .horizontal-timeline .items .items-list {
    padding-top: 15px;
    }
    .hero {
      padding-bottom: 0;
    }
</style>
@endsection

@section('content')

<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-4 h-50">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-12">
        <div class="card border-top border-bottom border-3" style="border-color: #7fad39 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-2" style="color: #000;">Thank you for your order, Your payment has been received.</p>

            <p class="lead fw-bold mb-5" style="color: #7fad39;">Purchase Reciept</p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Date</p>
                <p>10 April 2021</p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Order No.</p>
                <p>012j1gvs356c</p>
              </div>
            </div>

            <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
              @foreach($order->orderItems as $orderItem)
              <div class="row">
                <div class="col-md-8 col-lg-9">
                  <p>{{ $orderItem->product->title }}</p>
                </div>
                <div class="col-md-4 col-lg-3">
                <p>${{ $orderItem->product->getPrice() }}</p>
                </div>
              </div>
              @endforeach
              <div class="row">
                <div class="col-md-8 col-lg-9">
                  <p class="mb-0">Tax</p>
                </div>
                <div class="col-md-4 col-lg-3">
                  <p class="mb-0">${{ number_format( $order->tax / 100 , 2, ',', ',') }}</p>
                </div>
              </div>
            </div>

            <div class="row my-4">
              <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                <p class="lead fw-bold mb-0" style="color: #7fad39;">
                ${{ number_format( ( $order->price ) / 100 , 2, ',', ',') }}
                </p>
              </div>
            </div>

            <p class="mt-4 pt-2 mb-0">Want any help? <a href="#!" style="color: #7fad39;">Please contact
                us</a></p>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection