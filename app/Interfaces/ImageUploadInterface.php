<?php

namespace App\Interfaces;

interface ImageUploadInterface {

    public function upload($file);

    public function deleteFile($file);
} 