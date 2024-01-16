<?php

require_once 'bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['profile'])) {

    $loggedInUser = $_SESSION['username'];
    $profileUser = $_GET['profile'];

    // Esegui la logica per il toggle di seguimento
    if ($dbh->isFollowing($loggedInUser, $profileUser)) {
        $dbh->unfollow($loggedInUser, $profileUser);
        echo 'Follow';
    } else {
        $dbh->follow($loggedInUser, $profileUser);
        echo 'Unfollow';
    }
} else {
    // Altri controlli, se necessari
    http_response_code(400); // Bad Request
}

?>