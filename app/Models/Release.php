<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Release extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'publication_id',
        'name',
        'description',
        'image',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [

    ];

    protected $hidden = [

    ];

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

}
