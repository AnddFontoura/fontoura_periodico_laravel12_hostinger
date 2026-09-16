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

        $seo = $this->buildSeo(
            title: $homePage?->name ?? config('app.name'),
            description: $homePage?->getMetaDescription()
                ?? 'Biblioteca de artigos científicos e publicações da Fontoura Periódicos.',
            url: route('home'),
        );

        return Inertia::render('Welcome', [
            'homePage' => $homePage,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'seo' => $seo,
        ]);
    }

    public function page(string $pageSlug): Response
    {
        $pageInfo = $this->pageRepository->getBySlug($pageSlug);

        $seo = $this->buildSeo(
            title: $pageInfo?->name,
            description: $pageInfo?->getMetaDescription(),
            url: route('home.page', $pageSlug),
        );

        return Inertia::render('Page', [
            'page' => $pageInfo,
            'seo' => $seo,
        ]);
    }

    /**
     * Assemble the SEO metadata shared with the front-end (title, meta description,
     * canonical URL and Open Graph / Twitter fields).
     *
     * @return array<string, string>
     */
    private function buildSeo(?string $title, ?string $description, string $url): array
    {
        $siteName = config('app.name', 'Fontoura Periódicos');

        $fullTitle = $title
            ? sprintf('%s | %s', $title, $siteName)
            : $siteName;

        $description = $description
            ?: 'Biblioteca de artigos científicos e publicações da Fontoura Periódicos.';

        return [
            'title' => $fullTitle,
            'description' => $description,
            'url' => $url,
            'siteName' => $siteName,
            'image' => asset('img/logo_fontoura.png'),
            'type' => 'website',
            'locale' => str_replace('_', '-', app()->getLocale()),
        ];
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

    /**
     * Generate an XML sitemap so search engines can discover every public URL.
     */
    public function sitemap(): \Illuminate\Http\Response
    {
        $urls = [];

        $urls[] = ['loc' => route('home'), 'priority' => '1.0'];

        foreach ($this->pageRepository->getAll() as $page) {
            if ($page->slug) {
                $urls[] = [
                    'loc' => route('home.page', $page->slug),
                    'lastmod' => optional($page->updated_at)->toAtomString(),
                    'priority' => '0.8',
                ];
            }
        }

        foreach ($this->categoryRepository->getAll() as $publication) {
            $urls[] = [
                'loc' => route('home.publications', $publication->id),
                'lastmod' => optional($publication->updated_at)->toAtomString(),
                'priority' => '0.7',
            ];
        }

        foreach ($this->subCategoryRepository->getAll() as $release) {
            $urls[] = [
                'loc' => route('home.release', $release->id),
                'lastmod' => optional($release->updated_at)->toAtomString(),
                'priority' => '0.6',
            ];
        }

        foreach ($this->articleRepository->getAll() as $article) {
            $urls[] = [
                'loc' => route('home.article', $article->id),
                'lastmod' => optional($article->updated_at)->toAtomString(),
                'priority' => '0.6',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1) . '</loc>' . "\n";

            if (!empty($url['lastmod'])) {
                $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            }

            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
