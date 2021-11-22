<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Div extends Model
{
    protected $table = "divs";
    protected $fillable = ['division','description'];
}
