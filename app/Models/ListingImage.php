<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    protected $table = 'listing_images';
    protected $guarded = [];

    public function listings() {
        return $this->belongsTo(Listings::class);
    }
}
