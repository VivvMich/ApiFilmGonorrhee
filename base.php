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
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">

            <a class="navbar-brand text-light" href="#">APG FILMS <img src="popcorn.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="d-flex flex-grow-1 mx-5">
                <input id="search" class="form-control mx-auto" type="search" placeholder="Rechercher un film" aria-label="Search" style="max-width: 600px;">
                <ul class="list-group mt-2 d-flex flex-column position-absolute" id="results"></ul>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (!isset($_SESSION['name'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="view/login.php">
                                <h5>Connexion</h5>
                            </a>
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
            </div>
        </div>
    </nav>
</body>

</html>