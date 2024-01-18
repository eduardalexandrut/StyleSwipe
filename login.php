<?php
require_once 'bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if($login_result !== null){
        registerLoggedUser($login_result);
    } else {
        $templateParams["errorelogin"] = "Error! Incorrect email and/or password.";
    }
}

if(isUserLoggedIn()){
    $templateParams["title"] = "Home";
    $templateParams["name"] = "home.php";
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["profilepic"] = $_SESSION["profilepic"];
    header("Location: home.php");
    exit();
}
else{
    $templateParams["title"] = "Login";
    require "template/login-form.php";
}

?>