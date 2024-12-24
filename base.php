<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/ApiFilmGonorrhee/">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="main.js"></script>
    <title>api films</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">

            <a class="navbar-brand text-light" href="<?php echo isset($_SESSION['firstname_user']) ? 'film_index.php' : 'index.php'; ?>">
                APG FILMS <img src="popcorn2.png" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="search d-flex w-100 flex-column mx-auto">
                <input id="search" class="form-control" type="search" placeholder="Rechercher un film" aria-label="Search">
                <ul class="list-group mt-2 position-absolute" id="results"></ul>
            </div>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (!isset($_SESSION['firstname_user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="sign.php">
                                <h5>Inscription</h5>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="login_form.php">
                                <h5>Connexion</h5>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="logout.php">
                                <h5>Deconnexion</h5>
                            </a>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>