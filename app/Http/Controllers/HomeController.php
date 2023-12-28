<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use App\Models\RecipeCategory;
use App\Models\Recipe;


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

        $recipeController = new RecipeController();
        $recipes = $recipeController->fetchAll();
        if ($recipes instanceof \Illuminate\Http\JsonResponse) {
            $recipes = $recipes->getData(true);
        }

        return view('start', compact('categorySanitized', 'recipes'));
    }
    public function filter(int $category)
    {
        //Get recipes
        $recipeController = new RecipeController();
        $recipes = $recipeController->fetchByCategory($category);
        if ($recipes instanceof \Illuminate\Http\JsonResponse) {
            $recipes = $recipes->getData(true);
        }

        //Get categories
        if (!is_numeric($category)) {
            return redirect()->route('home');
        }
        if (!isset($_SESSION['categories'])) {
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
            $_SESSION['categories'] = $categorySanitized;
        }
        $categorySanitized = $_SESSION['categories'];


        return view('start', compact('categorySanitized', 'recipes'));
    }
}
