<?php

include "pdo.php";

var_dump($_FILES);

if (
    !empty($_POST['firstname_user']) &&
    !empty($_POST['lastname_user']) &&
    !empty($_POST['mail_user']) &&
    !empty($_POST['psw_user']) &&
    !empty($_POST['birthday_user'])


) {

    // Exemple d'algo de hashage
    // md5, sha1, sha2, sha256, sha512
    // Argon2 => Argon2I et l'Argon2d

    $psw = password_hash($_POST["psw_user"], PASSWORD_ARGON2I);

    if (isset($_FILES['image_user'])) {

        // C'est le nom du fichier que l'on a uploadé
        $fileName = $_FILES["image_user"]["name"];
        // C'est sa taille en octets.
        $fileSize = $_FILES["image_user"]["size"];
        // C'est le nom temporaire, ce qui correspond au fichier, cela permet de le manipuler pendant qu'il est chargé.
        $tmpName = $_FILES["image_user"]["tmp_name"];

        // Imaginons un fichier "jambon.png" => ["jambon", "png"];
        $tabExtension = explode('.', $fileName);
        // end recupère le dernier élément d'un tableau
        // sachant qu'une extension sera toujours en dernier dans le tableau.
        // Pour eviter des probleme de compatibiliter et simplifier le code, on mettra l'extension en minuscule, et surtout cela nous permettra de faciliter la verification des extensions
        $extension = strtolower(end($tabExtension));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

        if (in_array($extension, $validExtensions)) {
            if ($fileSize < 2097152) {

                $newName = sha1(uniqid(mt_rand(), true)) . $_POST['firstname_user'] . '_' . $_POST['lastname_user'] . '.' . $extension;

                try {
                    $success = move_uploaded_file($tmpName, "image/upload/" . $newName);
                } catch (Exception $e) {
                    $message_error = $e->getMessage();
                    header("Location: login_form.php?message=$message_error&status=error");
                }



                if ($success) {

                    $sql = "INSERT INTO user (firstname_user, lastname_user, mail_user, psw_user, birthday_user, image_user) VALUES (?,?,?,?,?,?)";

                    $stmt = $pdo->prepare($sql);
                    $verif = $stmt->execute([
                        $_POST["firstname_user"],
                        $_POST["lastname_user"],
                        $_POST["mail_user"],
                        $psw,
                        $_POST["birthday_user"],
                        $newName
                    ]);
                    if ($verif) {
                        header("Location: login_form.php?message=Inscription réussie&status=success");
                    } else {
                        header("Location: login_form.php?message=Erreur serveur, appelez le developpeur.&status=error");
                    }
                } else {
                    // Problème lors du déplacement du fichier
                    header("Location: login_form.php?message=Problème pendant l'upload du fichier, un message a été envoyé aux developpeurs&status=error");
                }
            } else {
                // Taille de fichier invalide
                header("Location: login_form.php?message=Le fichier doit avoir une taille inferieure à 2 Mo&status=error");
            }
        } else {
            // Ex format invalide
            header("Location: login_form.php?message=Format de fichiers invalides&status=error");
        }
    } else {
        // header("Location: ../view/add_user_form.php?message=le else du fichier de sa mère.&status=error");
    }
} else {
    // Ici le formulaire est mal remplis
    header("Location: login_form.php?message=Veuillez remplir le formulaire correctement&status=error");
}
