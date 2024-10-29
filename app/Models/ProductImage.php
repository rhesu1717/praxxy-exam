<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $table = 'product_images';
    
    protected $primaryId = 'id';

    protected $fillable = [
        'product_id',
        'folder',
        'filename'
    ];
}
