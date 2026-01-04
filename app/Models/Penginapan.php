<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'listings';
    protected $guarded = [];

    public function images() {
        return $this->hasMany(ListingImage::class, 'listings_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function facilities() {
        return $this->belongsToMany(Facility::class, 'facility_listings', 'listings_id', 'facility_id');
    }

    public function coverImage() {
        return $this->hasOne(ListingImage::class, 'listings_id')->where('isCover', true);
    }
    public function kamarImage() {
        return $this->hasOne(ListingImage::class, 'listings_id')->where('isKamar', true);
    }
    public function imageGeneral() {
        return $this->hasMany(ListingImage::class, 'listings_id')
        ->where('isKamar', false)
        ->where('isCover', false);
    }
}
