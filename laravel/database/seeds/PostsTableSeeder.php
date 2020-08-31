<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Commnet;

class PostsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
      factory(Post::class, 4)
          ->create()
          ->each(function ($post) {
              $comments = factory(App\Comment::class, 2)->make();
              $post->comments()->saveMany($comments);
          });
  }
}
