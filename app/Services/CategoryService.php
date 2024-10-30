<?php

namespace App\Services;

use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryService implements CategoryInterface {
    public function list(){
        $categories = Category::all();

        return $categories;
    }
}