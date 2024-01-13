<?php
require_once 'bootstrap.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $dateOfBirth = $_POST["dateOfBirth"];
        $gender = $_POST["gender"];

        $registration_result = $dbh->registerUser($name, $surname, $username, $password, $dateOfBirth, $gender);

        if (!$registration_result) {
            $templateParams["erroreRegistrazione"] = "Errore durante la registrazione. Riprova!";
        } else {
            registerLoggedUser($registration_result);
        }
    }

    if(isUserLoggedIn()){
        $templateParams["title"] = "Home";
        $templateParams["name"] = "home.php";
        require("template/base.php");
    }
    else{
        $templateParams["title"] = "Register";
        require("template/register-form.php");
    }

?>