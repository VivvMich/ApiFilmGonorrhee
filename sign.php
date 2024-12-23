<?php
include "base.php";
?>

<body>
    <div class="container">
        <h1 class="text-center text-primary">Inscription</h1>

        <form action="sign_controller.php" method="POST" class="w-50 mx-auto" enctype="multipart/form-data">
            <label class="form-label" for="firstname_user">Prénom</label>
            <input class="form-control" type="text" name="firstname_user" placeholder="Prénom" required>

            <label class="form-label" for="lastname_user">Nom</label>
            <input class="form-control" type="text" name="lastname_user" placeholder="Nom" required>

            <label class="form-label" for="birthday_user">Date de naissance</label>
            <input class="form-control" type="date" name="birthday_user">

            <label class="form-label" for="mail_user">E-mail</label>
            <input class="form-control" type="email" name="mail_user" placeholder="E-mail" required>

            <label class="form-label" for="psw_user">Mot de passe</label>
            <input class="form-control" type="password" name="psw_user" placeholder="Mot de passe" required>

            <label class="form-label" for="image_user">Image de profil</label>
            <input class="form-control" type="file" name="image_user" accept="image/*">

            <div class="text-center">
                <input class="btn btn-primary mt-3" type="submit" value="Je m'inscris">
            </div>
        </form>
    </div>
</body>

</html>

</html>