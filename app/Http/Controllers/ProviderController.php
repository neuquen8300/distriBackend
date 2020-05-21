<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProvider;
use App\Http\Requests\ValidateNewProvider;
use App\Location;
use Illuminate\Http\Request;
use App\Provider;

class ProviderController extends Controller
{
    public function getProviders(){
        $providers = Provider::all();
        return $providers;
    }

    public function getSingleProvider($id){
        $provider = Provider::find($id);
        return $provider;
    }

    public function addProvider(ValidateNewProvider $request){
        $provider = $request->validated();
        $newProvider = new Provider();

        $newProvider->name = $provider['name'];
        $newProvider->businessName = $provider['businessName'];
        $newProvider->cuit = $provider['cuit'];
        $newProvider->active = 1;
        $newProvider->save();
        $newProvider->location_id = $this->createLocation($provider['location_id'], $newProvider->id);

        return response('ok');
    }

    public function updateProvider(UpdateProvider $request, $id){
        $updatedProvider = $request->validated();

        Provider::where('id', $id)->update([
            'name' => $updatedProvider['name'],
            'businessName' => $updatedProvider['businessName'],
            'cuit' => $updatedProvider['cuit'],
            'location_id' => $this->createLocation($updatedProvider['location_id'], true),
            'active' => $updatedProvider['active']
        ]);

        return response('ok');
    }

    //Aux methods

    private function createLocation($location, $id, $update = false){

        $newLocation = new Location();
        $newLocation->address = $location['address'];
        $newLocation->zipCode = $location['zipCode'];
        $newLocation->city = $location['city'];
        $newLocation->province = $location['province'];
        $newLocation->country = $location['country'];
        $newLocation->locationBelongsTo = "provider";
        $newLocation->reference_id = $id;

        if ($update == true){
            Location::where('reference_id', $id)->update([
                'active' => 0
            ]);
        }

        $newLocation->active = $location['active'];

        $newLocation->save();
        
        return $newLocation->id;
    }
}
