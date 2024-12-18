<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'date_and_time'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
