<?php

namespace App\Services;

use App\Interfaces\ImageUploadInterface;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ImageUploadService implements ImageUploadInterface {
    public function upload($file){

        if($file->hasFile('filepond')) {
            $file = $file->file('filepond');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('products/tmp/'. $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }

    public function deleteFile($folder){

        $temporaryImage = TemporaryFile::where('folder', $folder)->first();
        if($temporaryImage){
            Storage::deleteDirectory('products/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }
        
        return '';
    }
}