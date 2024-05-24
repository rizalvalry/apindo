<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function get_product_image(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

//    public function getSrc(){
//        $this->get_product_image()->map(function ($image){
//            $image->src = getFile($image->driver, $image->product_image);
//            return $image;
//        });
//    }

    public function get_product_image_modify(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function getListing(){
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
