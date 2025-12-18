<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $guarded = [];
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime'
    ];

    public function listings() {
        return $this->belongsTo(Listings::class);
    }
}
