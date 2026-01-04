<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';
    protected $guarded = [];

    public function listings() {
        return $this->belongsToMany(Listings::class);
    }

    public function penginapans() {
        return $this->belongsToMany(Penginapan::class, 'facility_listings', 'facility_id', 'listings_id');
    }
}
