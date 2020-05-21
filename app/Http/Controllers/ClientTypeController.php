<?php

namespace App\Http\Controllers;

use App\ClientType;
use Illuminate\Http\Request;

class ClientTypeController extends Controller
{
    public function getClientTypes(){
        $clientTypes = ClientType::all();
        return $clientTypes;
    }
    public function getSingleClientType($id){
        $clientType = ClientType::find($id);
        return $clientType;
    }
}
