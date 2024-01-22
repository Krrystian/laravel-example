<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecipeController;
use Session;
use App\Models\User;

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

    static public function fetchUser(string $email)
    {
        if (!(Auth::check() && Auth::user()->privilege == true)) {
            toastr()->error(
                'You do not have permission to do that action',
                'Permission denied',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect('home');
        }
        $user = User::where('email', 'LIKE', '%' . $email . '%')->select('id', 'name', 'email', 'suspended')->first();
        if (!$user) {
            toastr()->error(
                'User does not exist',
                'User not found',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return null;
        }
        $user = $user->toArray();
        return response()->json([$user]);
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
    public function suspendUser(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('login');
        if (!Auth::user()->privilege) {
            toastr()->error(
                'You do not have permission to do that action',
                'Permission denied',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect('home');
        }
        try {
            $request->validate([
                'id' => 'required|integer|exists:users,id',
            ]);
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'User not found',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect('admin');
        }
        $user = User::find($request->id);
        $user->suspended = true;
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
        return redirect()->route('admin');
    }
}
