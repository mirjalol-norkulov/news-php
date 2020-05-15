<?php
session_start();

require_once("../DBConnection.php");

$conn = DBConnection::getConnection();

$email = $_POST['email'];
$password = $_POST['password'];

// TODO Email va parolni borligini tekshirish kerak
// Agar email yoki porol bo'lmasa
// $_SESSION["error"] = "Email yoki parolni jo'nating"

$email = mysqli_real_escape_string($conn, $email);

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user["id"];
        header("Location:/");
    }
}