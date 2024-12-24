<?php

include "pdo.php";

// Fonction utilitaire pour rediriger avec message
function redirectWithMessage($location, $message, $status)
{
    header("Location: $location?message=" . urlencode($message) . "&status=$status");
    exit;
}

// Fonction pour calculer l'âge
function calculateAge($birthday)
{
    $dob = new DateTime($birthday);
    $now = new DateTime();
    return $dob->diff($now)->y;
}

if (!empty($_POST['mail_user']) && !empty($_POST['psw_user'])) {
    $email = filter_var($_POST['mail_user'], FILTER_SANITIZE_EMAIL); // Nettoyer l'email
    $password = $_POST['psw_user'];

    try {
        // Préparer la requête pour vérifier si l'utilisateur existe
        $sql = "SELECT id_user, firstname_user, lastname_user, psw_user, birthday_user FROM user WHERE mail_user = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        // Récupérer les données utilisateur
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérification du mot de passe
            if (password_verify($password, $user['psw_user'])) {
                // Calculer l'âge de l'utilisateur
                $age = calculateAge($user['birthday_user']);
                $isAdult = $age >= 18;

                // Démarrer une session utilisateur
                session_start();
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['firstname_user'] = $user['firstname_user'];
                $_SESSION['lastname_user'] = $user['lastname_user'];
                $_SESSION['name'] = $user['firstname_user'];
                $_SESSION['isAdult'] = $isAdult; // Stocker si l'utilisateur est majeur

                // Redirection vers la page d'accueil
                redirectWithMessage("film_index.php", "Connexion réussie", "success");
            } else {
                // Mot de passe incorrect
                redirectWithMessage("login_form.php", "Mot de passe incorrect", "error");
            }
        } else {
            // Email non trouvé
            redirectWithMessage("login_form.php", "Utilisateur introuvable", "error");
        }
    } catch (Exception $e) {
        // Gestion des erreurs serveur
        error_log("Erreur lors de la connexion : " . $e->getMessage());
        redirectWithMessage("login_form.php", "Erreur serveur, veuillez réessayer", "error");
    }
} else {
    // Champs non remplis
    redirectWithMessage("login_form.php", "Veuillez remplir tous les champs", "error");
}
