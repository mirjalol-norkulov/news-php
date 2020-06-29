<?php
session_start();

require '../vendor/autoload.php';

use App\Auth\Auth;
use App\Utils\Session;

// Redirect user to homepage if already logged in
if (Auth::isLoggedIn()) {
    header("Location:/");
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <title>Kirish</title>
</head>
<body>
<div class="container">
    <div class="row login">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Kirish</h3>
                    <form action="auth.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   class="form-control <?= Session::has("errors.email") ? "is-invalid" : "" ?>"
                                   id="email" name="email">
                            <?php if (Session::has("errors.email")): ?>
                                <span class="invalid-feedback">
                                <?= Session::pop("errors.email") ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Parol</label>
                            <input type="password"
                                   class="form-control <?= Session::has("errors.password") ? "is-invalid" : "" ?>"
                                   id="password" name="password">
                            <?php if (Session::has("errors.password")): ?>
                                <span class="invalid-feedback">
                                <?= Session::pop("errors.password"); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" name="remember" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Meni eslab qol
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Kirish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>