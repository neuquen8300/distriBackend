<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentMethod;
use App\Http\Requests\ValidateNewPaymentMethod;
use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function getMethods(){
        $methods = PaymentMethod::all();
        return $methods;
    }

    public function getSingleMethod($method){
        $singleMethod = PaymentMethod::where('name', "=", $method);
        return $singleMethod;
    }

    public function addPaymentMethod(ValidateNewPaymentMethod $request){

        $paymentMethod = $request->validate();
        $newPaymentMethod = new PaymentMethod();

        $newPaymentMethod->name = $paymentMethod['name'];
        $newPaymentMethod->active = 1;

        $newPaymentMethod->save();

        return response('ok');
    }

    public function updatePaymentMethod(UpdatePaymentMethod $request, $id){

        $updatedPaymentMethod = $request->validated();
        PaymentMethod::where('id', $id)->update([
            'name' => $updatedPaymentMethod['name'],
            'active' => $updatedPaymentMethod['active']
        ]);
    }
}
