<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProduct;
use App\Http\Requests\UpdateStock;
use App\Http\Requests\ValidateNewProduct;
use App\Product;
use App\Stock;
use App\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){
        $products = Product::all();
        return $products;
    }

    public function getSingleProduct($id){
        $product = Product::find($id);
        return $product;
    }

    public function addProduct(ValidateNewProduct $request){

        $product = $request->validate();

        $newProduct = new Product();
        $newProduct->name = $product['name'];
        $newProduct->brand = $product['brand'];
        $newProduct->price = $product['price'];
        $newProduct->unitsPerBox = $product['unitsPerBox'];
        $newProduct->byWeight = $product['byWeight'];
        $newProduct->provider_id = $product['provider_id'];
        $newProduct->active = 1;

        $newProduct->save();

        foreach(Warehouse::all() as $warehouse){
            $newStock = new Stock();

            $newStock->product_id = $newProduct->id;
            $newStock->warehouse_id = $warehouse->id;
            $newStock->amount = 0;

            $newStock->save();
        }
        
        return response('ok');
    }

    public function updateProduct(UpdateProduct $request, $id){
        $updatedProduct = $request->validated();
        Product::where('id', $id)->update([
            'name' => $updatedProduct['name'],
            'brand' => $updatedProduct['brand'],
            'price' => $updatedProduct['price'],
            'unitsPerBox' => $updatedProduct['unitsPerBox'],
            'byWeight' => $updatedProduct['byWeight'],
            'stock' => $this->updateStock($updatedProduct['stock'], $id),
            'active' => $updatedProduct['active']
        ]);
        return response('ok');
    }

    //AUX METHODS

    private function updateStock(UpdateStock $request, $id){
        $stock = $request->validated();
        
        Stock::where('id', $id)->where('warehouse_id', $stock['warehouse_id'])->update([
            'amount' => $stock['amount']
        ]);
    }
}
