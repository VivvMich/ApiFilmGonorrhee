<?php session_start();
include "controller.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/ApiFilmGonorrhee/">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="main.js"></script>
    <title>api films</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">APG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <?php if (!isset($_SESSION['name'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="view/login.php">Connexion</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="controller/logout.php">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view/user_profile_form.php">Profil</a>
                        </li>
                    <?php } ?>

                </ul>
                <div class=" position-relative">
                    <input id="search" class="form-control me-2" type="search" placeholder="Rechercher un gosse" aria-label="Search">
                    <ul class="list-group mt-2 d-flex flex-column position-absolute"
                        id="results"></ul>
                </div>
            </div>
        </div>
    </nav>