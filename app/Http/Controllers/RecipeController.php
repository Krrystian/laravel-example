<?php

namespace App\Http\Controllers;

use App\Models\RecipeCategory;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Session;

class RecipeController extends Controller
{
    public function fetchAll()
    {
        $recipes = Recipe::where('public', true)->select('id', 'title', 'prep_time', 'cook_time', 'instructions', 'image')->get();
        return response()->json($recipes);
    }
    public function fetchByCategory(int $category)
    {
        if (!is_numeric($category)) {
            return redirect()->route('home');
        }
        $recipes = RecipeCategory::where('category_id', $category)->get()->toArray();
        $recipes = array_map(function ($recipe) {
            return $recipe['recipe_id'];
        }, $recipes);

        $recipes = Recipe::whereIn('id', $recipes)
            ->where('public', true)
            ->select('id', 'title', 'prep_time', 'cook_time', 'instructions', 'image')
            ->get();
        return response()->json($recipes);
    }
    public static function fetchByUser(int $user)
    {
        // Jeśli użytkownik nie jest zalogowany lub próbuje wyświetlić przepisy innego użytkownika, to przekierowujemy go na stronę główną
        if (!is_numeric($user) || $user != Auth::user()->id) {
            return redirect()->route('home');
        }
        $recipes = Recipe::where('user_id', $user)
            ->where('public', true)
            ->select('id', 'title', 'prep_time', 'cook_time', 'instructions', 'image')
            ->get();
        return response()->json($recipes);
    }
    public static function fetchByNewest()
    {
        $recipes = Recipe::where('public', true)
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'prep_time', 'cook_time', 'instructions', 'image')
            ->get();

        return response()->json($recipes);
    }

    public static function fetchByLongest()
    {
        $recipes = Recipe::where('public', true)
            ->orderBy('prep_time', 'desc')
            ->select('id', 'title', 'prep_time', 'cook_time', 'instructions', 'image')
            ->get();
        return response()->json($recipes);
    }


    public function create()
    {
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
        return view('recipes.create', compact('categorySanitized'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        $newImageName = time() . '-' . $validatedData['title'] . '.' . $validatedData['image']->extension();
        $recipe->image = $newImageName;
        $validatedData['image']->storeAs('public', $newImageName);

        $recipe->save();

        $recipeId = $recipe->id;
        $categoryId = $validatedData['category'];

        $category_recipe = new RecipeCategory();
        $category_recipe->recipe_id = $recipeId;
        $category_recipe->category_id = $categoryId;
        $category_recipe->save();
        return redirect()->route('home');
    }


    public function show(int $recipe)
    {
        if (!is_numeric($recipe)) {
            return redirect()->route('home');
        }

        $recipe = Recipe::find($recipe)->toArray();
        if (!$recipe) {
            return redirect()->route('home');
        }
        //category rozszerzamy o nazwę kategorii
        $recipe['category'] = RecipeCategory::where('recipe_id', $recipe['id'])->first()->category()->first()->toArray();
        //e to skrót od htmlspecialchars
        $recipe['ingredients'] = nl2br(e($recipe['ingredients']));
        $recipe['instructions'] = nl2br(e($recipe['instructions']));
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $recipe)
    {
        if (!is_numeric($recipe)) {
            return redirect()->route('home');
        }

        $recipe = Recipe::find($recipe)->toArray();
        if (!$recipe) {
            return redirect()->route('home');
        }
        //category rozszerzamy o nazwę kategorii
        $recipe['category'] = RecipeCategory::where('recipe_id', $recipe['id'])->first()->category()->first()->toArray();
        $categorySanitized = Session::get('categories');
        return view('recipes.edit', compact('recipe', 'categorySanitized'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'instructions' => 'required',
                'ingredients' => 'required',
                'prep_time' => 'required|date_format:H:i:s',
                'cook_time' => 'required|date_format:H:i:s',
                'servings' => 'required|numeric',
                'category' => 'required|exists:categories,id',
            ]);
            $recipe = Recipe::find($id);
            $recipe->title = $validatedData['title'];
            $recipe->instructions = $validatedData['instructions'];
            $recipe->ingredients = $validatedData['ingredients'];
            $recipe->prep_time = $validatedData['prep_time'];
            $recipe->cook_time = $validatedData['cook_time'];
            $recipe->servings = $validatedData['servings'];
            if (isset($validatedData['image'])) {
                $newImageName = time() . '-' . $validatedData['title'] . '.' . $validatedData['image']->extension();
                $recipe->image = $newImageName;
                $validatedData['image']->storeAs('public', $newImageName);
            }
            $recipe->save();
            return redirect()->route('recipe.edit', ['recipe' => $recipe->id]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $recipe)
    {
        $recipe = Recipe::find($recipe);
        if (!$recipe) {
            return redirect()->route('home');
        }
        if ($recipe->user_id != Auth::user()->id) {
            return redirect()->route('home');
        }
        $recipe->public = false;
        $recipe->save();

        return redirect()->route('user');
    }
}
