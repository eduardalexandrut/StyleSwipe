<?php

    require_once 'bootstrap.php';

    $templateParams["name"] = "post-detail-view.php";
    $templateParams["title"] = "Post Detail";
    $idPost = -1;
    if(isset($_GET["postId"])){
        $idPost = $_GET["postId"];
    }
    $templateParams["post"] = $dbh->getPostById($idPost);

    require_once 'template/base.php';

?>