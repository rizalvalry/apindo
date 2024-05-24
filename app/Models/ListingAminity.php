<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingAminity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function get_amenity(){
        return $this->belongsTo(Amenity::class, 'amenity_id');
    }

}
