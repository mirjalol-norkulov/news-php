<?php


namespace App\Controllers;

use App\DB\DBConnection;
use App\DB\Models\News;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NewsController
 * @package App\Controllers
 */
class NewsController extends BaseController
{
    public function index(Request $request)
    {
        $limit = $request->query->get('limit') ?: 10;
        $offset = $request->query->get('offset') ?: 0;

        $news = News::paginate($limit, $offset);
        $this->render('news.html.twig', [
            'news' => $news,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

    public function create()
    {
        $this->render('news/create.html.twig');
    }

    public function createSave(Request $request)
    {
        $data = [];
        if ($image = $request->files->get('image')) {
            $filename = uniqid() . $image->getClientOriginalName();
            $image->move('./uploads/images', $filename);
            $data['image'] = '/uploads/images/' . $filename;
        }

        $conn = DBConnection::getConnection();

        $data['name'] = mysqli_real_escape_string($conn, $request->request->get('name'));
        $data['content'] = mysqli_real_escape_string($conn, $request->request->get('content'));

        News::create($data);

        header("Location:/news");
    }

    public function edit(Request $request, int $id, bool $auth)
    {
        $news = News::get($id);
        $this->render('news/edit.html.twig', [
            'news' => $news
        ]);
    }

    public function editSave(Request $request, int $id)
    {
        $data = [];
        if ($image = $request->files->get('image')) {
            $filename = uniqid() . $image->getClientOriginalName();
            $image->move('./uploads/images', $filename);
            $data['image'] = '/uploads/images/' . $filename;
        }

        $data['name'] = $request->request->get('name');
        $data['content'] = $request->request->get('content');

        News::update($id, $data);

        return header("Location: /news");
    }

    public function delete(int $id)
    {
        News::delete($id);
        header("Location:/news");
    }
}