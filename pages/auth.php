<?php
session_start();

require_once("../DBConnection.php");

$conn = DBConnection::getConnection();

$errors = [];
if (!$_POST['email']) {
    $errors['email'] = "Email manzilni kiriting";
}

if (!$_POST['password']) {
    $errors['password'] = "Parolni kiriting";
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    header("Location: {$_SERVER["HTTP_REFERER"]}");
}

$email = $_POST['email'];
$password = $_POST['password'];
$remember = $_POST["remember"];

$email = mysqli_real_escape_string($conn, $email);

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user["id"];

        header("Location:/");
        if ($remember) {
            setcookie("user", $user["id"], time() + 86400 * 7);
        }
    } else {
        $_SESSION["errors"]["password"] = "Email yoki parol noto'g'ri kiritildi";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
    }
} else {
    $_SESSION["errors"]["password"] = "Email yoki parol noto'g'ri kiritildi";
    header("Location: {$_SERVER["HTTP_REFERER"]}");
}