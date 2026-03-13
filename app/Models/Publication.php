<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
