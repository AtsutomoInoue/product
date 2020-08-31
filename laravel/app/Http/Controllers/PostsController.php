<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\Posts;
use Illuminate\Pagination\LengthAwarePaginator;

class PostsController extends Controller
{
  public function __construct()
  {
  $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
      $query = Post::query();
      $query = Post::orderBy('id', 'desc');
      $posts = $query->get();

      $Paginate = new LengthAwarePaginator(
            $posts->forPage($request->page, 5),
            $posts->count(),
            5,
            $request->page,
            array('path' => $request->url())
            );

      return view('posts.index',['posts' => $Paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Posts $request)
    {
      Post::create($request->all());
      return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::findOrFail($id);

      return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);

      return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $update = [
        'title' => $request->title,
        'body' => $request->body
      ];
      Post::where('id', $id)->update($update);
      return redirect()->route('posts.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);
      \DB::transaction(function () use ($post){
        $post->comments()->delete();
        $post->delete();
      });

      return redirect()->route('posts.index');
    }
}
