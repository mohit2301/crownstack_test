<?php

namespace App\Http\Resources;
use App\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
       $product = Product::find($this->product_id);
     
        return [
            'productID' => $this->product_id,
            'Name' => $product->name,
            'price' => $product->price,
            'Make' => $product->make,
            'Description'=>$product->description,
            'Quantity' => $this->quantity,
        ];
    }
}
