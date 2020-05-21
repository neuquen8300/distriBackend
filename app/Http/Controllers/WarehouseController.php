<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateNewWarehouse;
use App\Location;
use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function getWarehouses(){
        $warehouses = Warehouse::all();

        return $warehouses;
    }

    public function getSingleWarehouse($id){
        $warehouse = Warehouse::find($id);

        return $warehouse;
    }

    public function addWarehouse(ValidateNewWarehouse $request){
        $warehouse = $request->validated();

        $newWarehouse = new Warehouse();

        $newWarehouse->name = $warehouse->name;

        $newWarehouse->save();
        $newWarehouse->location = $this->createLocation($warehouse['location'], $newWarehouse->id, true);

        return response('ok');
    }

    private function createLocation($location, $id, $update = false){

        $newLocation = new Location();
        $newLocation->address = $location['address'];
        $newLocation->zipCode = $location['zipCode'];
        $newLocation->city = $location['city'];
        $newLocation->province = $location['province'];
        $newLocation->country = $location['country'];
        $newLocation->locationBelongsTo = "warehouse";
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
