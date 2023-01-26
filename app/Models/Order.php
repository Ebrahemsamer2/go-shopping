<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'country',
        'city',
        'zipcode',
        'notes',
        'price', 
        'tax',
        'payment_method', 
        'address_line_1',
        'address_line_2',
        'ship_address_line_1',
        'ship_address_line_2',
        'status'
    ];

    public const STRIPE_PAYMENT_METHOD = 'STRIPE';
    public const PAYPAL_PAYMENT_METHOD = 'PAYPAL';

    public const PENDING_ORDER_STATUS = 'pending';
    public const CANCELLED_ORDER_STATUS = 'cancelled';
    public const COMPLETED_ORDER_STATUS = 'completed';

    public function updateStatus($new_status) {
        if($this->update(['status' => $new_status])) {
            \Cart::instance('default')->destroy();
            return true;
        }
        return false;
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
