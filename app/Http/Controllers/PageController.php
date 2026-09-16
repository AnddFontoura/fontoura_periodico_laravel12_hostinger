<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\PageCreateOrUpdateRequest;
use App\Http\Requests\Page\PageListRequest;
use App\Repository\Pages\PageRepository;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function __construct(
        protected PageRepository $pageRepository,
    ) {
    }

    public function index(PageListRequest $request): Response
    {
        $filters = $request->validated();

        $pages = $this->pageRepository->paginateOrderById($filters);

        return Inertia::render('Admin/Page/PageList', [
            'pages' => $pages,
        ]);
    }

    public function create(?int $id = null): Response
    {
        $page = null;

        if ($id) {
            $page = $this->pageRepository->getById($id);
        }

        return Inertia::render('Admin/Page/PageForm', [
            'page' => $page,
        ]);
    }

    public function saveOrUpdate(PageCreateOrUpdateRequest $request, ?int $id = null)
    {
        $data = $request->validated();

        $data['home_page'] = (bool) ($data['home_page'] ?? false);
        $data['slug'] = Str::slug($data['name']);

        if ($id) {
            $this->pageRepository->updateById($id, $data);
        } else {
            $page = $this->pageRepository->create($data);
            $id = $page->id;
        }

        // Only one page can be flagged as the home page at a time.
        if ($data['home_page']) {
            $this->pageRepository->clearHomePageFlag($id);
        }
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {
        $this->pageRepository->deleteById($id);
    }
}
