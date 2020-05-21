<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOffer;
use App\Http\Requests\ValidateNewOffer;
use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function getOffers(){
        $offers = Offer::all();
        return $offers;
    }

    public function getSingleOffer($id){
        $offer = Offer::find($id);
        return $offer;
    }

    public function addOffer(ValidateNewOffer $request){

        $offer = $request->validated();
        $newOffer = new Offer();
        $newOffer->product_id = $offer['product_id'];
        $newOffer->paymentMethod_id = $offer['paymentMethod_id'];
        $newOffer->discountType = $offer['discountType'];
        $newOffer->discountAmount = $offer['discountAmount'];
        $newOffer->expirationDate = $offer['expirationDate'];
        $newOffer->byProduct = $offer['byProduct'];
        $newOffer->byPayment = $offer['byPayment'];
        $newOffer->active = 1;

        $newOffer->save();
    }

    public function updateOffer(UpdateOffer $request, $id){
        $updatedOffer = $request->validated();
        Offer::where('id', $id)->update([
            'product_id' => $updatedOffer['product_id'],
            'paymentMethod_id' => $updatedOffer['paymentMethod_id'],
            'discountType' => $updatedOffer['discountType'],
            'discountAmount' => $updatedOffer['discountAmount'],
            'expirationDate' => $updatedOffer['expirationDate'],
            'byProduct' => $updatedOffer['byProduct'],
            'byPayment' => $updatedOffer['byPayment'],
            'active' => $updatedOffer['active']
        ]);
    }
    
}
