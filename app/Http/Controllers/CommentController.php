<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function edit(string $comment_id)
    {
        $comment = Comment::find($comment_id)->toArray();
        return view('comments.edit', compact('comment'));
    }
    public function update(Request $request)
    {
        try {
            $request->validate([
                'comment' => 'required',
                'id' => 'required',
            ]);
            $comment = Comment::find($request->id);
            $user_id = $comment->user_id;
            if ($user_id != Auth::id()) {
                toastr()->error(
                    'You are not authorized to edit this comment',
                    'Unauthorized',
                    [
                        'positionClass' => 'toast-bottom-right',
                        'progressBar' => false,
                        'timeOut' => 2000,
                        'closeButton' => true,
                    ]
                );
                return redirect()->back();
            }
            $comment->comment = $request->comment;
            $comment->save();
            toastr()->success(
                'Comment updated successfully',
                'Success',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->route('recipe.show', $comment->recipe_id);
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'recipe_id' => 'required',
                'comment' => 'required',
            ]);

            if (!Auth::check()) {
                toastr()->error(
                    'You must be logged in to comment',
                    'Login required',
                    [
                        'positionClass' => 'toast-bottom-right',
                        'progressBar' => false,
                        'timeOut' => 2000,
                        'closeButton' => true,
                    ]
                );
                return redirect()->back();
            }
            $comment = new Comment();
            $comment->recipe_id = $request->recipe_id;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->save();
            toastr()->success(
                'Comment added successfully',
                'Success',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        }
    }
    public static function fetchReportedComments()
    {
        $comments = Comment::where('visible', true)
            ->where('reported', true)
            ->with(['user:id,email,suspended', 'recipe:id,title'])
            ->get()
            ->toArray();
        return response()->json($comments);
    }
    public function destroy(Request $request)
    {
        try {
            request()->validate([
                'id' => 'required',
                'user_id' => 'required',
            ]);
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        }
        if (!Auth::user()->privilege) {
            if (Auth::user()->getAuthIdentifier() != $request->user_id) {
                toastr()->error(
                    'You are not authorized to delete this comment',
                    'Unauthorized',
                    [
                        'positionClass' => 'toast-bottom-right',
                        'progressBar' => false,
                        'timeOut' => 2000,
                        'closeButton' => true,
                    ]
                );
                return redirect()->back();
            }
        }
        try {
            $comment = Comment::find($request->id);
            $comment->visible = false;
            $comment->reported = false;
            $comment->save();
            toastr()->success(
                'Comment deleted successfully',
                'Success',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect('admin');
        }
    }
    public function verify(Request $request)
    {
        if (!Auth::user()->privilege) {
            return redirect()->route('home');
        }
        try {
            request()->validate([
                'id' => 'required',
            ]);
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect('admin');
        }
        try {
            $comment = Comment::find($request->id);
            $comment->reported = false;
            $comment->save();
            toastr()->success(
                'Comment verified successfully',
                'Success',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
            return redirect('admin');
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );
        }
    }
    public function report(Request $request)
    {
        try {
            request()->validate([
                'id' => 'required',
            ]);
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]
            );

            return redirect()->back();
        }
        try {
            $comment = Comment::find($request->id);
            $comment->reported = true;
            $comment->save();
            toastr()->success(
                'Comment reported successfully',
                'Success',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,
                ]

            );
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error(
                'Something went wrong',
                'Error',
                [
                    'positionClass' => 'toast-bottom-right',
                    'progressBar' => false,
                    'timeOut' => 2000,
                    'closeButton' => true,

                ]
            );
            return redirect()->back();
        }
    }

}
