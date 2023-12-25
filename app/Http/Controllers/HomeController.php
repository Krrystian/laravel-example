<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->fetchAll();
        // Sprawdzamy czy $categories jest instancją klasy \Illuminate\Http\JsonResponse 
        // (czyli czy został zwrócony JSON) i jeśli tak, to pobieramy dane z tego
        if ($categories instanceof \Illuminate\Http\JsonResponse) {
            $categories = $categories->getData(true);
        }

        $categorySanitized = [];
        foreach ($categories as $category) {
            $categorySanitized[$category['id']] = $category['name'];
        }

        return view('start', compact('categorySanitized'));
    }
}
