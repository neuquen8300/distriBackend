<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ["client_id", "products", "seller_id", "paymentMethod_id", "active"];
}
