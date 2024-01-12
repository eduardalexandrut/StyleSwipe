<?php
require_once 'bootstrap.php';

/*if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Username e/o password errati.";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    $templateParams["titolo"] = "Home";
    $templateParams["nome"] = "home.php";
}
else{
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "login-form.php";
}*/
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "login-form.php";
    
?>