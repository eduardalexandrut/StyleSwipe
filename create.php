<?php
require_once 'bootstrap.php';


$templateParams["title"] = "New Outfit";
$templateParams["name"] = "create-view.php";

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $comment = $_POST['comment'];

    $user = "Eduard";

    $success = $dbh->createPost($user, $comment);
    echo $success;
}

require 'template/base.php';
?>