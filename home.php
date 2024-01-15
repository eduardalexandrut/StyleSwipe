<?php
require_once 'bootstrap.php';
$templateParams["name"] = "home-view.php";
$templateParams["title"] = "Home";
$templateParams["post"] = $dbh->getPostsOfFollowing($_SESSION["username"]);

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //Get content from input.
    $json_data = file_get_contents('php://input');
    // Decode JSON data
    $data = json_decode($json_data, true);

    // Check if action and post_id are set.
    if (isset($data['action'], $data['postId'])) {
        $action = $data['action'];
        $postId = $data['postId'];
        
        //Check type of action.
        if ($action == "LIKE") {
            $dbh->addLike($postId, $_SESSION["username"]);
            //Generate notification.
        } else if ($action == "UNLIKE") {
            $dbh->removeLike($postId, $_SESSION["username"]);
            //Generate notification.
        } else if ($action == "STAR") {
            $dbh->addStar($postId, $_SESSION["username"]);
            //Generate notification.
        } else if ($action == "UNSTAR") {
            $dbh->removeStar($postId, $_SESSION["username"]);
            //Generate notification.
        } else if ($action == "COMMENT") {
            //Generate notification.

        }
    } else {
        // Missing action or post_id.
    }

}

require 'template/base.php';
?>