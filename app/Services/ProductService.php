<?php 

namespace App\Services;

use App\Interfaces\ImageUploadInterface;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductInterface{

    public function __construct(
        protected ImageUploadInterface $image_upload
    ) {
    }
    
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
        
        $products = $products->orderBy('created_at', 'desc')->paginate();

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

    public function store($request){
        try {
            
            $name = $request->name;
            $categoryId = $request->categoryId;
            $description = $request->description;
            $date_and_time = $request->dateTime;
            $tempImagesUploaded = $request->tempImagesUploaded;

            DB::beginTransaction();
            
            $product = Product::create(['name' => $name, 'category_id' => $categoryId, 'description' => $description, 'date_and_time' => $date_and_time]);

            foreach ($tempImagesUploaded as $image) {
                $tmp = TemporaryFile::where('folder', $image)->first();

                ProductImage::create(['product_id' => $product->id, 'folder' => $tmp->folder, 'filename' => $tmp->filename]);
            }

            DB::commit();

            return response()->json([],201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([], 400);
        } 
    }

    public function edit($id){
        $productDetails = Product::with('images')->where('id', $id)->first();
        return $productDetails;
    }

    public function update($request, $id){
        try {
            $name = $request->name;
            $categoryId = $request->categoryId;
            $description = $request->description;
            $date_and_time = $request->dateTime;
            $tempImagesUploaded = $request->tempImagesUploaded;

            DB::beginTransaction();

            Product::where('id', $id)
                ->update(['name' => $name, 'category_id' => $categoryId, 'description' => $description, 'date_and_time' => $date_and_time]);
            
            // Remove old images
            ProductImage::where('product_id', $id)->delete();
            
            // Insert updated images
            foreach ($tempImagesUploaded as $image) {
                $tmp = TemporaryFile::where('folder', $image)->first();

                ProductImage::create(['product_id' => $id, 'folder' => $tmp->folder, 'filename' => $tmp->filename]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return false;
        }
    }
}