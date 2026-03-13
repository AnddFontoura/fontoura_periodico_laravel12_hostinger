<?php

namespace App\Http\Controllers;

use App\Http\Requests\Publication\PublicationCreateOrUpdateRequest;
use App\Http\Requests\Publication\PublicationListRequest;
use App\Repository\Publication\PublicationRepository;
use Inertia\Inertia;
use Inertia\Response;

class PublicationController extends Controller
{
    public function __construct(
      protected PublicationRepository $publicationRepository,
    ) {
    }

    public function index(PublicationListRequest $request): Response
    {
        $filters = $request->validated();

        $publications = $this->publicationRepository->paginateOrderById($filters);

        return Inertia::render('Admin/Publication/PublicationList', [
            'publications' => $publications,
        ]);
    }

    public function create(int $id = null)
    {
        $publication = null;

        if ($id !== null) {
            $publication = $this->publicationRepository->getById($id);
        }

        return Inertia::render('Admin/Publication/PublicationForm', [
            'publication' => $publication,
        ]);
    }

    public function saveOrUpdate(PublicationCreateOrUpdateRequest $request, ?int $id = null)
    {
        $data = $request->validated();

        if ($id !== null) {
            $publication = $this->publicationRepository->updateById($id, $data);
        } else {
            $publication = $this->publicationRepository->create($data);
        }
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {
        $this->publicationRepository->deleteById($id);
    }
}
