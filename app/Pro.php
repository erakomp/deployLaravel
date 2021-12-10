<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro extends Model
{
    protected $table='statuses';
    protected $fillable = [
        'title', 'color', 'source_type'
    ];
}
