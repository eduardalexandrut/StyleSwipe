<?php
require_once 'bootstrap.php';

// Controlla se è stato fornito un parametro 'user_id' nella query string
$username = isset($_GET['username']) ? $_GET['username'] : null;

// Se non è fornito, visualizza il profilo dell'utente loggato
if (empty($username)) {
    $username = $_SESSION["username"];
    $templateParams["profilepic"] = $_SESSION["profilepic"];
    $templateParams["username"] = $_SESSION["username"];
// Altrimenti, visualizza il profilo dell'utente specificato
} else {
    // Esempio di query per ottenere i dati dell'utente specifico dal database
    $userData = $dbh->getUserByUsername($username);

    // Se l'utente specificato esiste, mostra il suo profilo
    if ($userData) {
        $templateParams["profilepic"] = $userData["profile_image"];
        $templateParams["username"] = $userData["username"];
        $templateParams["isFollowing"] = $dbh->isFollowing($_SESSION["username"], $userData["username"]);
    } else {
        echo "Utente non trovato";
        exit();
    }
}

$templateParams["followers"] = $dbh->getFollowers($username);
$templateParams["followings"] = $dbh->getFollowings($username);
$templateParams["numFollowers"] = $dbh->getFollowersCount($username);
$templateParams["numFollowings"] = $dbh->getFollowingsCount($username);
$templateParams["numPosts"] = $dbh->getPostsCount($username);
$templateParams["publishedPosts"] = $dbh->getPostsOfUser($username);

$templateParams["name"] = "profile-view.php";
$templateParams["title"] = "Profile";

require 'template/base.php';
?>
