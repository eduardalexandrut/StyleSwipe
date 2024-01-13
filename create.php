<?php
require_once 'bootstrap.php';


$templateParams["title"] = "New Outfit";
$templateParams["name"] = "create-view.php";

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $comment = $_POST['comment'];

    $user = "Eduard";

    //Decode all the Items from JSON.
    $items = json_decode($_POST['items'], true);
    $postId = $dbh->createPost($user, $comment);

    if ($postId) {

    }
}

require 'template/base.php';
?>