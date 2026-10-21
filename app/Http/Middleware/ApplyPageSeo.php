<?php

namespace App\Http\Middleware;

use App\Seo;
use Closure;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Symfony\Component\HttpFoundation\Response;

class ApplyPageSeo
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only process public GET requests.
        if (
            !$request->isMethod('GET') ||
            $request->is('admin', 'admin/*', 'api', 'api/*')
        ) {
            return $next($request);
        }

        // Allow the controller to set its existing SEO first.
        $response = $next($request);

        // Only apply metadata to successful HTML responses.
        if (
            !$response->isSuccessful() ||
            !str_contains(
                strtolower($response->headers->get('Content-Type', '')),
                'text/html'
            )
        ) {
            return $response;
        }

        // Get the current URL without the domain or query string.
        $path = trim($request->path(), '/');

        // Homepage uses "home" as its SEO dashboard key.
        $pageKey = ($path === '' || $path === '/')
            ? 'home'
            : $path;

        // Look up any URL entered in the SEO dashboard.
        $page = Seo::where('route_name', $pageKey)->first();

        if (!$page) {
            return $response;
        }

        if (filled($page->seo_title)) {
            SEOMeta::setTitle($page->seo_title);
            OpenGraph::setTitle($page->seo_title);
            TwitterCard::setTitle($page->seo_title);
        }

        if (filled($page->seo_description)) {
            SEOMeta::setDescription($page->seo_description);
            OpenGraph::setDescription($page->seo_description);
            TwitterCard::setDescription($page->seo_description);
        }

        if (filled($page->seo_keywords)) {
            SEOMeta::setKeywords(
                array_map('trim', explode(',', $page->seo_keywords))
            );
        }

        return $response;
    }
}
