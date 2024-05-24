<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasePackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['purchase_date', 'expire_date', 'last_reminder_at', 'deleted_at'];

    public function get_fund(){
        return $this->hasMany(Fund::class, 'purchase_package_id', 'id');
    }

    public function pendingPackage(){
        return $this->hasMany(Fund::class, 'purchase_package_id', 'id')->where('status', 2);
    }

    public function get_package(){
        return $this->hasOne(PackageDetails::class, 'package_id','package_id');
    }

    public function get_user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPlanInfo(){
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function gateway(){
        return $this->hasOne(Fund::class, 'purchase_package_id')->latest();
    }

}
