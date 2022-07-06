<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getImage()
    {
        return $this->image == '' || strlen($this->image) == 0 ? 'assets/img/categories/cat-default.jpg' : 'assets/img/' . $this->image;
    }

    // Relations
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
