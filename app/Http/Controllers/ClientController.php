<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\UpdateClient;
use App\Http\Requests\ValidateNewClient;
use App\Location;

class ClientController extends Controller
{
    public function getClients(){
        
        $clients = Client::all();

        foreach($clients as $client){
            $client->location_id = Location::where('id', $client->location_id )->where('active','=', 1)->get();
        }
        return $clients;
    }

    public function getSingleClient($id){
        $client = Client::find($id);
        $client->location_id = Location::find($client->location_id);
        return $client;
    }

    public function getClientSearch($search){
        $clients = Client::where("name", "like", "%". $search . "%")
                        ->orWhere("id", "like", "%". $search . "%")
                        ->orWhere("businessName", "like", "%". $search . "%")
                        ->orWhere("cuit", "like", "%" . $search . "%")->get();

        return $clients;
    }

    public function addClient(ValidateNewClient $validated){
    
        $request = $validated->validated();
        
        $newClient = new Client();
        $newClient->name = $request['name'];
        $newClient->businessName = $request['businessName'];
        $newClient->cuit = $request['cuit'];
        $newClient->balance = 0;
        $newClient->clientType_id = $request['clientType_id'];
        $newClient->location_id = null;
        $newClient->active = 1;
        $newClient->save();
        $this->createLocation($request['location_id'], $newClient->id);
        return response('ok');
    }

    public function updateClient(UpdateClient $request, $id){

        $updatedClient = $request->validated();
        Client::where('id', $id)->update([
            'name' => $updatedClient['name'],
            'businessName' => $updatedClient['name'],
            'cuit' => $updatedClient['cuit'],
            'clientType_id' => $updatedClient['clientType_id'],
            'location_id' => $this->createLocation($updatedClient['location_id'], $id, true),
            'active' => $updatedClient['active']
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
        $newLocation->locationBelongsTo = "client";
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
