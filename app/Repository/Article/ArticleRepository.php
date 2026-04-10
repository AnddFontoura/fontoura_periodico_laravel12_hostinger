<?php

namespace App\Repository\Article;

use App\Models\Article;
use App\Repository\BaseRepository;

class ArticleRepository extends BaseRepository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function paginateByReleaseId(int $releaseId)
    {
        return $this->model
            ->where('release_id', $releaseId)
            ->paginate(15);
    }

    public function updateById(int $id, array $data): int
    {
        unset($data['pdf']);

        return $this->model
            ->where('id', $id)
            ->update($data);
    }
}
