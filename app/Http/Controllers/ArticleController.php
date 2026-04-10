<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleCreateOrUpdateRequest;
use App\Http\Requests\Article\ArticleListRequest;
use App\Http\Requests\Publication\PublicationCreateOrUpdateRequest;
use App\Repository\Article\ArticleRepository;
use App\Repository\Release\ReleaseRepository;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepository $articleRepository,
        protected ReleaseRepository $releaseRepository,
    ) {
    }

    public function index(ArticleListRequest $request): Response
    {
        $filters = $request->validated();

        $articles = $this->articleRepository->paginateOrderById($filters);

        return Inertia::render('Admin/Article/ArticleList', [
            'articles' => $articles,
        ]);
    }

    public function create(int $id = null)
    {
        $article = null;

        if ($id !== null) {
            $article = $this->articleRepository->getById($id);
        }

        return Inertia::render('Admin/Article/ArticleForm', [
            'article' => $article,
            'releases' => $this->releaseRepository->getReleasesForSelect()
        ]);
    }

    public function saveOrUpdate(ArticleCreateOrUpdateRequest $request, ?int $id = null)
    {
        $data = $request->validated();

        if ($id !== null) {
            $article = $this->articleRepository->updateById($id, $data);
        } else {
            $article = $this->articleRepository->create($data);
        }

        if ($data['pdf']) {
            //$fileName = $article->id . Str::slug($article->name) . Carbon::now()->timestamp;
            $fileName = Storage::disk('public')->put('articles', $request['pdf']);

            $article->path = $fileName;
            $article->save();
        }
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {
        $this->articleRepository->deleteById($id);
    }
}
