<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function fetchAll()
    {
        $categories = Category::all();
        $_SESSION['categories'] = $categories;
        return response()->json($categories);
    }
}
