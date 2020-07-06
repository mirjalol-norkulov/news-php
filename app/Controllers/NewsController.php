<?php


namespace App\Controllers;

use App\DB\DBConnection;

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

    public function edit()
    {
        echo "Edit";
    }
}