<?php
session_start();
require_once("DBConnection.php");
// isset = is set?
if (isset($_SESSION["user"])) {
    $userId = $_SESSION["user"];

    $conn = DBConnection::getConnection();

    $result = $conn->query("SELECT * FROM users WHERE id=$userId LIMIT 1");

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

if (isset($user)) {
    echo "<h1>Xush kelibsiz {$user['name']}</h1>";
} else {
    echo "<h1>Xush kelibsi mehmon!</h1>";
}