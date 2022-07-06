<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getThumbnail()
    {
        return $this->thumbnail == '' || strlen($this->thumbnail) == 0 ? 'assets/img/product/product-default.jpg' : 'assets/img/' . $this->thumbnail;
    }

    public function getPrice()
    {
        return number_format($this->price / 100, 2, ',', ',');
    }


    // Relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
