<?php 

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface{
    
    public function list($request){

        $category = $request->category ?? '';
        $search = $request->search ?? '';

        $products = Product::with('category');

        if($category!='all'){
            $products = $products->where('category_id', '=', $category); 
        }

        if($search!=null || $search!=''){
            $products = $products->where('category_id', '=', $category)
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhereHas('category', function($query) use($search) {
                $query->where('category_name', 'like', '%'.$search.'%');
            });
        }
        
        $products = $products->paginate();

        return $products;
    }

    public function delete($id){
        $isProductDelete = Product::findOrFail($id)->delete();

        if($isProductDelete){
            return true;
        }else{
            return false;
        }
    }
}