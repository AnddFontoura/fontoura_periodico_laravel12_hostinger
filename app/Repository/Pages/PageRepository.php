<?php

namespace App\Repository\Pages;

use App\Models\Page;
use App\Repository\BaseRepository;

final class PageRepository extends BaseRepository
{
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function getHomePage(): ?Page
    {
        return $this->model
            ->where('home_page', 1)
            ->first();
    }

    public function getBySlug(string $slug): ?Page
    {
        return $this->model
            ->where('slug', $slug)
            ->first();
    }
}
