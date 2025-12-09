<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['title', 'image_path'];

    public function listings() {
        return $this->hasMany(Listings::class);
    }
}
