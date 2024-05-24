<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimBusiness extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function get_client(){
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function get_listing(){
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
