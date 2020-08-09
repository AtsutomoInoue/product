<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycling extends Model
{
  protected $fillable = [
  'place',
  'address',
  'comment',
  ];
}
