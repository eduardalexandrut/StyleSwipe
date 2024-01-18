<?php

require_once 'bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['profile'])) {

    $loggedInUser = $_SESSION['username'];
    $profileUser = $_GET['profile'];

    if ($dbh->isFollowing($loggedInUser, $profileUser)) {
        $dbh->unfollow($loggedInUser, $profileUser);
        echo 'Follow';
    } else {
        $dbh->follow($loggedInUser, $profileUser);
        echo 'Unfollow';
    }
} else {
    http_response_code(400);
}

?>