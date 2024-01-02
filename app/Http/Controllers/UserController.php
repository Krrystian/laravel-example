<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecipeController;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user()->getAuthIdentifier();
        $recipes = RecipeController::fetchByUser($user);
        if ($recipes instanceof \Illuminate\Http\JsonResponse) {
            $recipes = $recipes->getData(true);
        }
        foreach ($recipes as &$recipe) {
            $recipe['likes'] = json_decode($recipe['likes'], true);
        }
        return view('user.index', compact('recipes'));
    }

    public function changeUsernameShow()
    {
        if (!Auth::check())
            return redirect()->route('login');

        return view('user.changeUsername');
    }
    public function changeUsername(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('login');

        $user = Auth::user();
        $request->validate([
            'username' => 'required|string|max:255|unique:users,name,' . $user->name,
        ]);
        $user->name = $request->username;
        $user->save();

        toastr()->success(
            'Username has been changed successfully',
            'Username changed',
            [
                'positionClass' => 'toast-bottom-right',
                'progressBar' => false,
                'timeOut' => 2000,
                'closeButton' => true,
            ]
        );
        return redirect()->route('user');
    }
}
