<?php
require_once 'bootstrap.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $dateOfBirth = $_POST["dateOfBirth"];
        $gender = $_POST["gender"];
        $profilepic = $_POST["profilepic"];

        if (isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"])) {
            // $_FILES["profilepic"] è definito e contiene un nome di file non vuoto
            list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["profilepic"]);
        
            if ($result != 0) {
                $profilepic = $msg;

                $registration_result = $dbh->registerUser($name, $surname, $username, $password, $dateOfBirth, $gender, $profilepic);

                if (!$registration_result) {
                    $templateParams["erroreRegistrazione"] = "Errore durante la registrazione. Riprova!";
                } else {
                    registerLoggedUser($registration_result);
                }
        
            } else {
                header("location: register.php?formmsg=" . $msg);
            }
        } else {
            $msg = "Errore: Nessun file caricato o file non valido.";
            header("location: register.php?formmsg=" . $msg);
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