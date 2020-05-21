<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ["name", "businessName", "cuit", "balance", "clientType_id", "location_id", "active"];
}
