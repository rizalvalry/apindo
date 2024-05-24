<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

//    public function getProductSrc(){
//       $this->map(function ($image){
//            $image->src = getFile($image->driver, $image->product_image);
//            return $image;
//        });
//    }

}
