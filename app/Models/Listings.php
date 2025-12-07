<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    protected $table = 'listings';
    protected $guarded = [];

    public function images() {
        return $this->hasMany(ListingImage::class);
    }

    public function coverImage() {
        return $this->hasOne(ListingImage::class)->where('isCover', true);
    }

    public function kamarImage() {
        return $this->hasOne(ListingImage::class)->where('isKamar', true);
    }

    public function facilities() {
        return $this->belongsToMany(Facility::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
