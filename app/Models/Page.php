<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'home_page',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
