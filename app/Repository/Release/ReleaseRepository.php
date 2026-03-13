<?php

namespace App\Repository\Release;

use App\Models\Release;
use App\Repository\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ReleaseRepository extends BaseRepository
{
    public function __construct(Release $model)
    {
        $this->model = $model;
    }

    public function getByPublicationId(int $publicationId)
    {
        return $this->model
            ->where('publication_id', $publicationId)
            ->get();
    }

    public function paginateOrderById(array $filters): LengthAwarePaginator
    {
        $sql = $this->model->with('publication');

        if (isset($filters['name'])) {
            $sql = $sql->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $sql->orderBy('id', 'desc')->paginate(10 );
    }

    public function getReleasesForSelect()
    {
        return $this->model
            ->with('publication')
            ->orderBy('id', 'desc')
            ->get();
    }
}
