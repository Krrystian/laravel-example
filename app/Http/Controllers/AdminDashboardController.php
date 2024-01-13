<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }
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
        $users = User::select('id', 'name', 'email', 'suspended')->get()->toArray();

        return view('dashboard.index', compact('categorySanitized', 'users'));
    }
    public function userSelect(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
        ]);
        $email = $request->email;

        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }
        $categorySanitized = Session::get('categories');
        $users = UserController::fetchUser($email);
        if ($users instanceof \Illuminate\Http\JsonResponse) {
            $users = $users->getData(true);
        }

        return view('dashboard.index', compact('categorySanitized', 'users'));
    }
}
