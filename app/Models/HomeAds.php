<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAds extends Model
{
    use HasFactory;

    public function getAdImage()
    {
        return $this->image == '' || strlen($this->image) == 0 ? 'assets/img/banner/banner-1.jpg' : 'assets/img/' . $this->image;
    }

    public static function latestAds($limit) {
        return self::latest()->where('active', 1)->take($limit)->get();
    }
}
