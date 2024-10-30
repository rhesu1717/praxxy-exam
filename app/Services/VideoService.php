<?php

namespace App\Services;

use App\Interfaces\VideoInterface;
use App\Models\Video;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class VideoService implements VideoInterface {

    public function index($request){

        $search = $request->search;

        $videos = Video::when($search, function($query) use($search){
            $query->where('name', 'like', '%'.$search.'%');
        })
        ->paginate();
        return $videos;
    }
    public function store($request){
        
        $url = $request->url;
        $name = $request->name;

        $response = Http::get($url);

        try {
            if($response->getStatusCode() == 200){
            
                $video = uniqid() . '-' . now()->timestamp . '.mp4';
                $video_src = 'videos/' . $video;
                Storage::disk('public')->put('videos/'. $video, $response->getBody());

                DB::beginTransaction();

                Video::create(['name' => $name, 'src' => $video_src]);

                DB::commit();

                return true;
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
        
    }

    public function destroy($id){

        $video = Video::where('id', $id)->delete();

        if($video){
            return true;
        }else{
            return false;
        }
    }
}