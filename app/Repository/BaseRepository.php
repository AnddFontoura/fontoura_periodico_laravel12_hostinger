<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    protected $model;

    public function getById(int $id): Model
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('id', 'desc')
            ->get();
    }

    public function paginateOrderById(array $filters): LengthAwarePaginator
    {
        $sql = $this->model;

        if (isset($filters['name'])) {
            $sql = $sql->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $sql->orderBy('id', 'desc')->paginate(10 );
    }

    public function updateById(int $id, array $data): int
    {
        return $this->model
            ->where('id', $id)
            ->update($data);
    }

    public function create(array $data): Model
    {
        foreach ($data as $key => $value) {
            if ($value === null) {
                unset($data[$key]);
            }
        }

        return $this->model
            ->create($data);
    }

    public function deleteById(int $id): bool
    {
        return $this->model->destroy($id);
    }
}
