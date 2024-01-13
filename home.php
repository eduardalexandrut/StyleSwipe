<?php
require_once 'bootstrap.php';
$templateParams["name"] = "home-view.php";
$templateParams["title"] = "Home";
$templateParams["post"] = $dbh->getPostsOfFollowing("Eduard");
require 'template/base.php';
?>