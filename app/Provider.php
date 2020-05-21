<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ["name", "businessName", "cuit", "location_id", "active"];
}
