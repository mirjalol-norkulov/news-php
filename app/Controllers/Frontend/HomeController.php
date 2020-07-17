<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\DB\Models\News;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package App\Controllers\Frontend
 */
class HomeController extends BaseController
{
    public function index()
    {
        $news = News::paginate(4, 0);
        $this->render('frontend/index.html.twig', ['news' => $news['items']]);
    }

    public function newsDetail(Request $request, int $id)
    {
        $news = News::get($id);
        $this->render('frontend/detail.html.twig', ['news' => $news]);
    }
}