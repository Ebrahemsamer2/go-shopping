<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public static function add( $request )
    {
        $product = Product::where('slug', $request->slug)->first();
        \Cart::instance( $request->cart_type )->add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug])->associate(Product::class);
        
        if( $request->cart_type == 'wishlist' )
            return response()->json( ['success' => 1, 'message' => 'Product has been added to wishlist.'] );
        else
            return response()->json( ['success' => 1, 'message' => 'Product has been added to cart.'] );
        
    }
}
