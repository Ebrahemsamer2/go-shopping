<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public static function getAll()
    {
        return \Cart::instance('default')->content();
    }

    public static function add( $request )
    {
        $product = Product::where('slug', $request->slug)->first();
        \Cart::instance( $request->cart_type )->add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug])->associate(Product::class);
        
        if( $request->cart_type == 'wishlist' )
            return response()->json( ['success' => 1, 'message' => 'Product has been added to wishlist.'] );
        else
            return response()->json( ['success' => 1, 'message' => 'Product has been added to cart.'] );
    }

    public static function remove( $rowId, $cart_type )
    {
        \Cart::instance( $cart_type )->remove($rowId);
        
        if( $cart_type == 'wishlist' )
            return response()->json( ['success' => 1, 'message' => 'Product has been removed to wishlist.'] );
        else
            return response()->json( ['success' => 1, 'message' => 'Product has been removed to cart.'] );
    }

    public static function updateCart( $request )
    {
        foreach( json_decode($request->rows) as $key => $rowId )
            \Cart::instance( $request->cart_type )->update($rowId, json_decode($request->qtys)[$key]);
        
        if( $request->cart_type == 'wishlist' )
            return response()->json( ['success' => 1, 'message' => 'Wishlist cart has been updated.'] );
        else
            return response()->json( ['success' => 1, 'message' => 'Cart has been updated.'] );
    }
}
