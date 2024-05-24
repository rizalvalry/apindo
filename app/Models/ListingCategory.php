<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function language()
    {
        return $this->hasMany(Language::class, 'language_id', 'id');
    }

    public function details()
    {
        return $this->hasOne(ListingCategoryDetails::class);
    }

    public function get_listings()
    {
        return $this->hasMany(Listing::class, 'category_id')->where('status', 1)->where('is_active', 1);
    }

    public function getCategoryCount()
    {
        return Listing::whereJsonContains('category_id', json_encode($this->id))->where('status', 1)->where('is_active', 1)->count();
    }
}
