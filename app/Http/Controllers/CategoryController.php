<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function fetchAll()
    {
        $categories = Category::where('visible', true)->get()->toArray();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            toastr()->error(
                'Add category',
                'Category name is required',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->route('admin');
        }
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        toastr()->success(
            'Category has been added successfully',
            'Category added',
            [
                'positionClass' => 'toast-bottom-right',
                'progressBar' => false,
                'timeOut' => 2000,
                'closeButton' => true,
            ]
        );
        if (Session::has('categories')) {
            $categorySanitized = Session::get('categories');
            $categorySanitized[$category->id] = $category->name;
            Session::put('categories', $categorySanitized);
        }

        return redirect()->route('admin');
    }
    public function destroy(Request $request)
    {
        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }

        try {
            $this->validate($request, [
                'category_id' => 'required|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            toastr()->error(
                'Delete category',
                'Category id is required',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->route('admin');
        }
        $category = Category::find($request->category_id);
        if (!$category) {
            toastr()->error(
                'Category does not exist',
                'Category not found',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->route('admin');
        }
        $category->visible = false;
        $category->save();
        toastr()->success(
            'Category has been deleted successfully',
            'Category deleted',
            [
                'positionClass' => 'toast-bottom-right',
                'progressBar' => false,
                'timeOut' => 2000,
                'closeButton' => true,
            ]
        );
        if (Session::has('categories')) {
            $categorySanitized = Session::get('categories');
            unset($categorySanitized[$category->id]);
            Session::put('categories', $categorySanitized);
        }
        return redirect()->route('admin');
    }
    public function edit(string $category_id)
    {
        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }
        $category = Category::find($category_id);
        if (!$category) {
            toastr()->error(
                'Category does not exist',
                'Category not found',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->route('admin');
        }
        return view('category.edit', ['category' => $category]);
    }
    public function update(Request $request)
    {
        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }
        try {
            $this->validate($request, [
                'id' => 'required|integer',
                'category' => 'required|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            toastr()->error(
                'Edit category',
                'Category id and name are required',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        }
        $category = Category::find($request->id);
        if (!$category) {
            toastr()->error(
                'Category does not exist',
                'Category not found',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        }
        $category->name = $request->category;
        $category->save();
        toastr()->success(
            'Category has been edited successfully',
            'Category edited',
            [
                'positionClass' => 'toast-bottom-right',
                'progressBar' => false,
                'timeOut' => 2000,
                'closeButton' => true,
            ]
        );
        if (Session::has('categories')) {
            $categorySanitized = Session::get('categories');
            $categorySanitized[$category->id] = $category->name;
            Session::put('categories', $categorySanitized);
        }
        return redirect()->route('admin');
    }

}
