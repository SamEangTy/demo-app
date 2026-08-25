<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'price',
        'qty',
        'description',
    ];
}
