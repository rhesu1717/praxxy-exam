<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\VideoInterface;
use Illuminate\Http\Request;

class ApiVideoController extends Controller
{
    public function __construct(
        protected VideoInterface $video
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = $this->video->index($request);

        if($result){
            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => $result,
            ]);
        }
        
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
    public function store(Request $request)
    {
        $result = $this->video->store($request);

        if($result){
            return response()->json([
                'success' => true,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
            ], 400);
        }
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->video->destroy($id);

        if($result){
            return response()->json([
                'success' => true,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 400);
        }
    }
}
