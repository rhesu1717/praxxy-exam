<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Interfaces\ImageUploadInterface;
use App\Interfaces\ProductInterface;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{

    public function __construct(
        protected ProductInterface $product,
        protected ImageUploadInterface $image_upload
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->product->list($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        return $this->product->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $result =  $this->product->edit($id);

        return response()->json([
            'data' => $result
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result =  $this->product->update($request, $id);

        if($result){
            return response()->json([
                'success' => true
            ], 200);
        }else{
            return response()->json([
                'success' => false
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->product->delete($id);
    }

    public function upload(Request $request)
    {
        return $this->image_upload->upload($request);
    }

    public function imageDelete($folder){
        return response($this->image_upload->deleteFile($folder));
    }
}
