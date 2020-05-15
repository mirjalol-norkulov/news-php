<?php session_start(); ?>
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
<div class="row login">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Kirish</h3>
                <form action="auth.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Parol</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kirish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>