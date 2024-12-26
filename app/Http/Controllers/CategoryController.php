<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category.view',[
            'category' => $category
        ]);
    }
}
