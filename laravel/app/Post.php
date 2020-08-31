<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
      'title',
      'name',
      'body',
  ];

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

}
