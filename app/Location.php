<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ["address", "zipCode", "city", "province", "country", 'locationBelongsTo', 'reference_id', 'active'];
}
