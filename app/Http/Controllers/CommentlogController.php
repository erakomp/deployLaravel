<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CommentlogController extends Controller
{
    public function getComment()
    {
        $getComm = DB::table('comments')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->join('tasks', 'comments.source_id', '=', 'tasks.id')
        ->select('comments.source_type', 'users.name', 'tasks.title', 'tasks.external_id as ei', 'comments.created_at', 'comments.description as desc')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('getcomm', compact('getComm'));
    }
}
