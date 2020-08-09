<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plamodel extends Model
{
    protected $fillable = [
        'name',
        'maker',
        'price',
        'released'
    ];
}
