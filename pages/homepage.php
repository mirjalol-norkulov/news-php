<?php


use App\DB\DBConnection;

// isset = is set?
$userId = null;
if (isset($_SESSION["user"])) {
    $userId = $_SESSION["user"];
} else if (isset($_COOKIE["user"])) {
    $userId = $_COOKIE["user"];
}

if ($userId) {
    $conn = DBConnection::getConnection();

    $result = $conn->query("SELECT * FROM users WHERE id=$userId LIMIT 1");

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <? if (isset($user)): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <?= $user['name']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profil</a>
                        <div class="dropdown-divider"></div>
                        <form action="pages/logout.php" method="post">
                            <button class="dropdown-item" type="submit">Chiqish</button>
                        </form>
                    </div>
                </li>
            <? else: ?>
                <li class="nav-item">
                    <a href="/pages/login.php" class="nav-link">Kirish</a>
                </li>
            <? endif; ?>
        </ul>
    </div>
</nav>

<script src="/assets/js/jquery-3.5.1.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.js"></script>
</body>
</html>