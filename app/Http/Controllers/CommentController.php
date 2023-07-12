<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store($id, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $id_user = Auth::id();
        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->user_id = $id_user;
        $comment->news_id = $id;
        $comment->save();
        return redirect()->back()->with('success', 'Data Comment berhasil Ditambahkan');
    }
}
