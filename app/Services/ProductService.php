<?php 

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface{
    
    public function list(){
        $products =  Product::paginate()
            ->withQueryString();

        return $products;
    }
}