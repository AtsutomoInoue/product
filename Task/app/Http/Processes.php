<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processes extends Model
{
  public $timestamps = false;

  protected $primaryKey = "process_id";

  public function tasks()
  {
    return $this->hasMany('App\Task');
  }
}
