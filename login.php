<?php
require_once 'bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if($login_result !== null){
        // Login riuscito, $login_result contiene i dati dell'utente
        registerLoggedUser($login_result);
    } else {
        // Login fallito
        $templateParams["errorelogin"] = "Errore! E-mail e/o password errati.";
    }
}

if(isUserLoggedIn()){
    $templateParams["title"] = "Home";
    $templateParams["name"] = "home.php";
    header("Location: home.php");
    exit();
}
else{
    $templateParams["title"] = "Login";
    require "template/login-form.php";
}

?>