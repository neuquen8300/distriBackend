<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeller;
use App\Http\Requests\ValidateNewSeller;
use Illuminate\Http\Request;
use App\Seller;
class SellerController extends Controller
{
    public function getSellers(){
        $sellers = Seller::all();
        return $sellers;
    }

    public function getSingleSeller($id){
        $seller = Seller::find($id);
        return $seller;
    }

    public function addSeller(ValidateNewSeller $request){
        $seller = $request->validated();

        $newSeller = new Seller();
        $newSeller->name = $seller['name'];
        $newSeller->role_id = $seller['role_id'];
        $newSeller->active = 1;

        $newSeller->save();

        return response('ok', 200);
    }
    public function updateSeller(UpdateSeller $request, $id){
        $updatedSeller = $request->validated();

        Seller::where('id', $id)->update([
            'name' => $updatedSeller['name'],
            'role_id' => $updatedSeller['role_id'],
            'active' => $updatedSeller['active']
        ]);

        return response('ok');
    }
}
