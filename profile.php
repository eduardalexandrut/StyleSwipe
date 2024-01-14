<?php
require_once 'bootstrap.php';

$templateParams["name"] = "profile-view.php";
$templateParams["title"] = "Profile";
$templateParams["profilepic"] = $_SESSION["profilepic"];
$templateParams["username"] = $_SESSION["username"];

require 'template/base.php';
?>