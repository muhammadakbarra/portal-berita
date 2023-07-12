<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, $comment_id)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $id_user = Auth::id();

        $reply = new Reply;
        $reply->content = $request->input('content');
        $reply->comment_id = $comment_id;
        $reply->user_id = $id_user;
        $reply->save();

        return redirect()->back()->with('success', 'Reply Berhasil Ditambahkan');
    }
}
