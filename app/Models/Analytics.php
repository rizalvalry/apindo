<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getListing()
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }

    public function listCount()
    {
        return $this->hasMany(Analytics::class, 'listing_id', 'listing_id');
    }

    public function lastVisited()
    {
        return $this->hasOne(Analytics::class,'listing_id','listing_id')->latest();
    }
}
