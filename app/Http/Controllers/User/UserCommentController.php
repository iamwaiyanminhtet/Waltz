<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class UserCommentController extends Controller
{
    // create new comment
    public function create(Request $request) {
        $data = [
            'description' => $request->description,
            'user_id' => $request->user_id,
            'blog_id' => $request->blog_id,
        ];
        Comment::create($data);
        $response = [
            'status' => 'success'
        ];
        return response()->json($response);
    }
}
