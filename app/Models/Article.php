<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'release_id',
        'name',
        'path',
        'authors',
        'resume',
        'abstract',
        'keywords',
        'image',
        'access_count',
        'download_count',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function release(): hasOne
    {
        return $this->hasOne(Release::class,'id', 'release_id');
    }
}
