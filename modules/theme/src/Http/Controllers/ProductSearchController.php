<?php

namespace Theme\Http\Controllers;

use Ecommerce\Services\ProductArchiveService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductSearchController extends Controller
{
    public function __invoke(Request $request, ProductArchiveService $archive, ThemeTemplateController $templates): View
    {
        return $templates->archiveView('search_results', $archive->search($request));
    }
}
