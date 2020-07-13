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
    public function index()
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT * FROM news LIMIT 10 OFFSET 0";
        $result = $conn->query($sql);

        $news = [];
        while ($newsItem = $result->fetch_assoc()) {
            array_push($news, $newsItem);
        }

        $this->render('news.html.twig', ['news' => $news]);
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

        $conn = DBConnection::getConnection();

        $data['name'] = mysqli_real_escape_string($conn, $request->request->get('name'));
        $data['content'] = mysqli_real_escape_string($conn, $request->request->get('content'));

        $sql = "UPDATE news SET name='{$data['name']}', " .
            "content = '{$data['content']}'";

        if ($data['image']) {
            $sql = $sql . ", image='{$data['image']}'";
        }

        $sql = $sql . " WHERE id=$id";

        $result = $conn->query($sql);

        if ($result) {
            header("Location:/news");
        }
    }

    public function delete(int $id)
    {
        News::delete($id);
        header("Location:/news");
    }
}