<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\Comments;

class CommentsController extends Controller
{
  public function store(Comments $request)
  {
    $params = $request->validate([
      'post_id' => 'required|exists:posts,id',
      'name' => '',
      'body' => '',
    ]);

    $post = Post::findOrFail($params['post_id']);
    $post->comments()->create($params);

    return redirect()->route('posts.show',['post'=>$post]);
  }
}
