<?php


session_start();

require_once('../vendor/autoload.php');

use App\DB\DBConnection;
use App\Utils\Session;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$conn = DBConnection::getConnection();

$errors = [];
if (!$request->request->has('email')) {
    $errors['email'] = "Email manzilni kiriting";
}

if (!$request->request->has('password')) {
    $errors['password'] = "Parolni kiriting";
}

if (!empty($errors)) {
    Session::put("errors", $errors);
    header("Location: {$_SERVER["HTTP_REFERER"]}");
}

$email = $request->request->get('email');
$password = $request->request->get('password');
$remember = $request->request->get('remember');

$email = mysqli_real_escape_string($conn, $email);

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user["password"])) {
        // Auth::login($user, true);
        Session::put("user", $user["id"]);
        header("Location:/");
        if ($remember) {
            setcookie("user", $user["id"], time() + 86400 * 7);
        }
    } else {
        Session::put('errors.password', "Email yoki parol noto'g'ri kiritildi");
        header("Location: {$request->server->get('HTTP_REFERER')}");
    }
} else {
    Session::put('errors.password', "Email yoki parol noto'g'ri kiritildi");
    header("Location: {$request->server->get('HTTP_REFERER')}");
}