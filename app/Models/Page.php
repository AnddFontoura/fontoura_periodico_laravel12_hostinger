<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'home_page',
        'slug',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Build a clean, search-engine-friendly description out of the rich-text body.
     * Strips HTML, collapses whitespace and limits the length for meta tags.
     */
    public function getMetaDescription(int $limit = 160): string
    {
        $plain = trim(html_entity_decode(strip_tags($this->description ?? '')));
        $plain = preg_replace('/\s+/', ' ', $plain);

        return Str::limit($plain, $limit);
    }
}
