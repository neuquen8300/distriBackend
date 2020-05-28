<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrder;
use App\Http\Requests\ValidateNewOrder;
use Illuminate\Http\Request;
use App\Order;
use Exception;

class OrderController extends Controller
{
    public function getOrders(){
        $orders = Order::all();
        return $orders;
    }
    public function getSingleOrder($id){
        $order = Order::find($id);
        return $order;
    }
    public function getOrderSearch($search){
        $orders = Order::where("name", "like", "%". $search . "%")
                        ->orWhere("id", "like", "%". $search . "%")
                        ->orWhere("businessName", "like", "%". $search . "%")
                        ->orWhere("cuit", "like", "%" . $search . "%")->get();

        return $orders;

    }
    public function addOrder(ValidateNewOrder $request){
        //Arreglando bugs
        $order = $request->validated();
        try{
            $newOrder = new Order();
            $newOrder->client_id = $order['client_id'];
            $newOrder->products = $order['products'];
            $newOrder->seller_id = $order['seller_id'];
            //$newOrder->paymentMethod_id = $order['paymentMethod_id'];
            $newOrder->active = 1;

            $newOrder->save();

            return response('ok'); 

        } catch (Exception $e) {
            return response('Hubo un error: '. $e, 400);
        }
    }

    public function updateOrder(UpdateOrder $request, $id){
        $updatedOrder = $request->validated();
        Order::where('id', $id)->update([
            'client_id' => $updatedOrder['client_id'],
            'products' => $updatedOrder['products'],
            'seller_id' => $updatedOrder['seller_id'],
            'paymentMethod_id' => $updatedOrder['paymentMethod_id'],
            'active' => $updatedOrder['active'] 
        ]);

        return response('ok');
    }
}
