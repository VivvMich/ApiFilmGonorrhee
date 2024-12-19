<?php
include "base.php";
?>


<h1 class="text-center text-primary">Inscription</h1>

<form action="controller.php" method="POST" class="w-25 mx-auto" enctype="multipart/form-data">

    <label class="form-label" for="firstname_user">Prénom</label>
    <input class="form-control" type="text" name="firstname_user" placeholder="Prénom">

    <label class="form-label" for="lastname_user">Nom</label>
    <input class="form-control" type="text" name="lastname_user" placeholder="Nom">

    <label class="form-label" for="birthday_user">Date de naissance</label>
    <input class="form-control" type="date" name="birthday_user" >

    <label class="form-label" for="mail_user">E-mail</label>
    <input class="form-control" type="text" name="mail_user" placeholder="Mail">

    <label class="form-label" for="psw_user">Mot de passe</label>
    <input class="form-control" type="text" name="psw_user" placeholder="Mot de passe">
    
    <label class="form-label" for="image_user">Image de profile</label>
    <input class="form-control" type="file" name="image_user" > 
    
    <div class="text-center">
        <input class="btn btn-primary mt-3" type="submit" value="je m'inscris" >
    </div>

</form>

</body>
</html>