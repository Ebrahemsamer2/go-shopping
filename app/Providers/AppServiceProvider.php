<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        if(request()->has('payment_method')) {
            $payment_method = request()->input('payment_method');
            $class_name = "\App\Services\Payment\\" . ucfirst($payment_method);
            if(!class_exists($class_name))
            {
                abort(500);
            }
            $this->app->bind(\App\Services\Payment\PaymentService::class, $class_name);
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

        Paginator::useBootstrapFive();
    }
}
