<?php

namespace App\Http\Controllers;

use App\Http\Requests\Publication\PublicationCreateOrUpdateRequest;
use App\Http\Requests\Release\ReleaseCreateOrUpdateRequest;
use App\Http\Requests\Release\ReleaseListRequest;
use App\Models\Publication;
use App\Repository\Publication\PublicationRepository;
use App\Repository\Release\ReleaseRepository;
use Inertia\Inertia;
use Inertia\Response;

class ReleaseController extends Controller
{
    public function __construct(
        protected ReleaseRepository $releaseRepository,
        protected PublicationRepository $publicationRepository,
    ) {
    }

    public function index(ReleaseListRequest $request): Response
    {
        $filters = $request->validated();

        $releases = $this->releaseRepository->paginateOrderById($filters);

        return Inertia::render('Admin/Release/ReleaseList', [
            'releases' => $releases,
        ]);
    }

    public function create(?int $id = null)
    {
        $release = null;

        if ($id) {
            $release = $this->releaseRepository->getById($id);
        }

        return Inertia::render('Admin/Release/ReleaseForm', [
            'release' => $release,
            'publications' => $this->publicationRepository->getAll()
        ]);
    }

    public function saveOrUpdate(ReleaseCreateOrUpdateRequest $request, ?int $id = null)
    {
        $data = $request->validated();

        if ($id) {
            $releases = $this->releaseRepository->updateById($id, $data);
        } else {
            $releases = $this->releaseRepository->create($data);
        }
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {
        $this->releaseRepository->deleteById($id);
    }
}
