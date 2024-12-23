<?php

include "base.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center text-primary">Connexion</h1>


        <?php
        if (isset($_GET['message'])) {
            $status = $_GET['status'] ?? 'info';
            echo "<div class='alert alert-$status text-center'>{$_GET['message']}</div>";
        }
        ?>


        <form action="login_controller.php" method="POST" class="w-50 mx-auto" enctype="multipart/form-data">
            <label class="form-label" for="mail_user">Email</label>
            <input class="form-control" type="email" name="mail_user" placeholder="Email" required>

            <label class="form-label" for="psw_user">Mot de passe</label>
            <input class="form-control" type="password" name="psw_user" placeholder="Mot de passe" required>

            <div class="text-center">
                <input class="btn btn-primary mt-3" type="submit" value="Connexion">
            </div>
        </form>
    </div>
</body>

</html>