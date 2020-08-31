<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('comments')->insert([
      [
        'post_id' => 1,
        'name' => '投稿者１',
        'body' => '本文１',
      ],
      [
        'post_id' => 2,
        'name' => '投稿者２',
        'body' => '本文２',
      ],
    ]);
  }
}
