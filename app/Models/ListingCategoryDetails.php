<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Translatable;

class ListingCategoryDetails extends Model
{
    use HasFactory, Translatable;

    protected $guarded = ['id'];

    protected $casts = [
        'details' => 'object'
    ];

    public function category(){
        return $this->belongsTo(ListingCategory::class, 'listing_category_id');
    }
}
