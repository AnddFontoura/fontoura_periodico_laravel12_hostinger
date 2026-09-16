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

    /**
     * Ensure a single home page exists by clearing the flag on every other page.
     */
    public function clearHomePageFlag(?int $exceptId = null): void
    {
        $query = $this->model->where('home_page', 1);

        if ($exceptId !== null) {
            $query->where('id', '!=', $exceptId);
        }

        $query->update(['home_page' => 0]);
    }
}
