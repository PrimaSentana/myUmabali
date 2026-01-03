<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'listings';

    public function images() {
        return $this->hasMany(ListingImage::class, 'listings_id');
    }
}
