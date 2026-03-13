<?php

namespace App\Http\Controllers;

use App\Repository\Article\ArticleRepository;
use App\Repository\Pages\PageRepository;
use App\Repository\Publication\PublicationRepository;
use App\Repository\Release\ReleaseRepository;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class WebsiteController extends Controller
{
    public function __construct(
        protected PageRepository $pageRepository,
        protected PublicationRepository $categoryRepository,
        protected ReleaseRepository $subCategoryRepository,
        protected ArticleRepository $articleRepository,
    ) {
    }

    public function index(): Response
    {
        $homePage = $this->pageRepository->getHomePage();

        return Inertia::render('Welcome', [
            'homePage' => $homePage,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function page(string $pageSlug): Response
    {
        $pageInfo = $this->pageRepository->getBySlug($pageSlug);

        return Inertia::render('Page', [
            'page' => $pageInfo,
        ]);
    }

    public function publications(int $publicationId): Response
    {
        $releases = $this->subCategoryRepository->getByPublicationId($publicationId);
        $publication = $this->categoryRepository->getById($publicationId);

        return Inertia::render('Publications', [
            'publication' => $publication,
            'releases' => $releases,
        ]);
    }

    public function release(int $releaseId): Response
    {
        $articles = $this->articleRepository->paginateByReleaseId($releaseId);
        $release = $this->subCategoryRepository->getById($releaseId);

        return Inertia::render('Release', [
            'articles' => $articles,
            'release' => $release,
        ]);
    }

    public function article(int $articleId): Response
    {
        $article = $this->articleRepository->getById($articleId);

        return Inertia::render('Article', [
            'pdf_url' => asset('storage/articles/'),
            'article' => $article,
        ]);
    }
}
