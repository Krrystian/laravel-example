<?php

namespace App\Http\Controllers;

use App\Models\RecipeCategory;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function fetchAll()
    {
        $recipes = Recipe::all();
        return response()->json($recipes);
    }

    public function create()
    {
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
        return view('recipes.create', compact('categorySanitized'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'instructions' => 'required',
            'ingredients' => 'required',
            'prep_time' => 'required|date_format:H:i',
            'cook_time' => 'required|date_format:H:i',
            'servings' => 'required|numeric',
            'category' => 'required|exists:categories,id',
        ]);

        $recipe = new Recipe();
        $recipe->title = $validatedData['title'];
        $recipe->instructions = $validatedData['instructions'];
        $recipe->ingredients = $validatedData['ingredients'];
        $recipe->prep_time = $validatedData['prep_time'];
        $recipe->cook_time = $validatedData['cook_time'];
        $recipe->servings = $validatedData['servings'];
        $recipe->user_id = Auth::user()->id;
        $recipe->save();

        $recipeId = $recipe->id;
        $categoryId = $validatedData['category'];

        $category_recipe = new RecipeCategory();
        $category_recipe->recipe_id = $recipeId;
        $category_recipe->category_id = $categoryId;
        $category_recipe->save();
        return redirect()->route('home');
    }

    public function show(string $id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recipe = Recipe::find($id);
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
        $recipe->save();

        return redirect()->route('recipes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();

        return redirect()->route('recipes.index');
    }
}
