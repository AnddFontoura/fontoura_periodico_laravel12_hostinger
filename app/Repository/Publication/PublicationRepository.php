<?php

namespace App\Repository\Publication;

use App\Models\Publication;
use App\Repository\BaseRepository;

final class PublicationRepository extends BaseRepository
{
    function __construct(Publication $model)
    {
        $this->model = $model;
    }

}
