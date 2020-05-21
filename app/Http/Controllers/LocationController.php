<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateNewLocation;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getLocations(){
        $locations = Location::all();
        return $locations;
    }
    public function getSingleLocation($id){
        $location = Location::find($id);
        return $location;
    }
    public function getLocationSearch($search){
        $locations = Location::where('street', 'like', '%'. $search . '%')
                            ->orWhere('streetNumber', 'like', '%'. $search . '%')
                            ->orWhere('zipCode', 'like', '%' . $search . '%')
                            ->orWhere('city', 'like', '%' . $search . '%')
                            ->orWhere('province', 'like', '%' . $search . '%')->get();

        return $locations;
    }
    public function addLocation(ValidateNewLocation $request){
        $location = $request->validated();
        $newLocation = new Location();

        $newLocation->address = $location['address'];
        $newLocation->zipCode = $location['zipCode'];
        $newLocation->city = $location['city'];
        $newLocation->province = $location['province'];
        $newLocation->country = $location['country'];
        $newLocation->locationBelongsTo = 'location';
        $newLocation->save();

        return response('ok');
    }
}
