<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Auth;
use Session;

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
        Session::put('categories', $categorySanitized);

        $recipeController = new RecipeController();
        $recipes = $recipeController->fetchAll();
        if ($recipes instanceof \Illuminate\Http\JsonResponse) {
            $recipes = $recipes->getData(true);
        }
        return view('start', compact('categorySanitized', 'recipes'));
    }
    public function filter(string $category)
    {
        //Get categories
        if (!Session::has('categories')) {
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
            Session::put('categories', $categorySanitized);
        }
        $categorySanitized = Session::get('categories');

        //Get recipes
        if (!is_numeric($category) && $category != 'newest' && $category != 'longest') {
            return redirect()->route('home');
        }
        if ($category == 'newest') {
            $recipeController = new RecipeController();
            $recipes = $recipeController->fetchByNewest();
            if ($recipes instanceof \Illuminate\Http\JsonResponse) {
                $recipes = $recipes->getData(true);
            }
        } else if ($category == 'longest') {
            $recipeController = new RecipeController();
            $recipes = $recipeController->fetchByLongest();
            if ($recipes instanceof \Illuminate\Http\JsonResponse) {
                $recipes = $recipes->getData(true);
            }
        } else {
            $recipeController = new RecipeController();
            $recipes = $recipeController->fetchByCategory($category);
            if ($recipes instanceof \Illuminate\Http\JsonResponse) {
                $recipes = $recipes->getData(true);
            }
        }

        return view('start', compact('categorySanitized', 'recipes'));
    }
    public function user()
    {
        $user = Auth::user()->getAuthIdentifier();
        $recipes = RecipeController::fetchByUser($user);
        if ($recipes instanceof \Illuminate\Http\JsonResponse) {
            $recipes = $recipes->getData(true);
        }

        return view('user.index', compact('recipes'));
    }
}
