<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'avgRating'
    ];

    protected $casts = [
        'category_id' => 'array',
    ];


    public function get_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function get_place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function get_listing_images()
    {
        return $this->hasMany(ListingImage::class, 'listing_id');
    }

    public function get_products()
    {
        return $this->hasMany(Product::class, 'listing_id');
    }

    public function get_listing_amenities()
    {
        return $this->hasMany(ListingAminity::class, 'listing_id');
    }

    public function get_business_hour()
    {
        return $this->hasMany(BusinessHour::class, 'listing_id');
    }

    public function get_reviews()
    {
        return $this->hasMany(UserReview::class, 'listing_id');
    }

    public function scopeReviews()
    {
        $query = $this->get_reviews()
            ->selectRaw('count(id) AS total')
            ->selectRaw('AVG(rating2) AS average')->toBase()->get()->toArray();

        return $query;
    }


    public function getTotalRatingAttribute()
    {
        return $this->get_reviews()->sum('rating2');
    }

    public function getAvgRatingAttribute()
    {
        return $this->get_reviews()->avg('rating2');
    }

    public function get_package()
    {
        return $this->belongsTo(PurchasePackage::class, 'purchase_package_id');
    }

    public function get_social_info()
    {
        return $this->hasMany(WebsiteAndSocial::class, 'listing_id');
    }

    public function getFavourite()
    {
        $clientId = null;
        if (Auth::check()) {
            $clientId = Auth::user()->id;
        }
        return $this->hasOne(Favourite::class, 'listing_id')->where('client_id', $clientId);

    }

    public function listingImages()
    {
        return $this->hasMany(ListingImage::class, 'listing_id');
    }

    public function listingSeo()
    {
        return $this->hasOne(ListingSeo::class, 'listing_id');
    }

    public function listingAnalytics()
    {
        return $this->hasMany(Analytics::class, 'listing_id');
    }

    public function listingClaims()
    {
        return $this->hasMany(ClaimBusiness::class, 'listing_id');
    }

    public function allWishlists()
    {
        return $this->hasMany(Favourite::class, 'listing_id');
    }

    public function productQueries()
    {
        return $this->hasMany(ProductQuery::class, 'listing_id');
    }

    public function listingViews()
    {
        return $this->hasMany(Viewer::class, 'listing_id');
    }

    public function getCategories(){
        return ListingCategory::with('details')->whereIn('id', $this->category_id)->get();
    }

    public function getCategoriesName(){
        return implode(" , ", ListingCategoryDetails::whereIn('listing_category_id', $this->category_id)->get()->pluck('name')->toArray());
    }
}
