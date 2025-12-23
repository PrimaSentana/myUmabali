<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function listing() {
        return $this->belongsTo(Listings::class);
    }

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
