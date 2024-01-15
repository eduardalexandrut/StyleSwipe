<?php
require_once 'bootstrap.php';

// Controlla se è stato fornito un parametro 'user_id' nella query string
$username = isset($_GET['username']) ? $_GET['username'] : null;

// Se non è fornito, visualizza il profilo dell'utente loggato
if (empty($username)) {
    $templateParams["profilepic"] = $_SESSION["profilepic"];
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["followers"] = $dbh->getFollowers($_SESSION["username"]);
    $templateParams["followings"] = $dbh->getFollowings($_SESSION["username"]);
}
// Altrimenti, visualizza il profilo dell'utente specificato
else {
    // Esempio di query per ottenere i dati dell'utente specifico dal database
    $userData = $dbh->getUserByUsername($username);

    // Se l'utente specificato esiste, mostra il suo profilo
    if ($userData) {
        $templateParams["profilepic"] = $userData["profile_image"];
        $templateParams["username"] = $userData["username"];
        $templateParams["followers"] = $dbh->getFollowers($userData["username"]);
        $templateParams["followings"] = $dbh->getFollowings($userData["username"]);
    } else {
        echo "Utente non trovato";
        exit();
    }
}

$templateParams["name"] = "profile-view.php";
$templateParams["title"] = "Profile";

require 'template/base.php';
?>
