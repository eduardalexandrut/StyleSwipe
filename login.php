<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if($login_result !== null){
        // Login riuscito, $login_result contiene i dati dell'utente
        registerLoggedUser($login_result);
    } else {
        // Login fallito
        $templateParams["errorelogin"] = "Errore! Username e/o password errati.";
    }
}

if(isUserLoggedIn()){
    $templateParams["title"] = "Home";
    $templateParams["name"] = "home.php";
    require "template/base.php";
}
else{
    $templateParams["title"] = "Login";
    require "template/login-form.php";
}

?>