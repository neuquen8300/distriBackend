<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ["product_id", "paymentMethod_id", "discountType", "discountAmount", "expirationDate", "byProduct", "byPayment", "active"];
}
