<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(request()->has('payment_method'))
        {
            $className = $this->generatePaymentClass(request()->get('payment_method'));
            $this->app->bind(\App\PaymentMethods\PaymentInterface::class, $className);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $main_categories = Category::orderBy('id', 'DESC')->take(10)->get();

            $wishlist_items_count = \Cart::instance('wishlist')->count();
            $cart_items_count = \Cart::instance('default')->count();
            $total_price =  number_format( (int) \Cart::subtotal(0,'','') / 100, 2, ',', ',');
            
            $view->with('main_categories', $main_categories);
            $view->with('wishlist_items_count', $wishlist_items_count);
            $view->with('cart_items_count', $cart_items_count);
            $view->with('total_price', $total_price);
        });
    }

    private function generatePaymentClass($class_name)
    {
        switch($class_name)
        {
            case 'stripe':
                return \App\PaymentMethods\Stripe::class;
            case 'paypal':
                return \App\PaymentMethods\Paypal::class;
        }
        throw new Exception("Error: Payment gateway {$class_name} is not found");
    }
}
