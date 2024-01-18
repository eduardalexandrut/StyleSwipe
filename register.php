<?php
require_once 'bootstrap.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $dateOfBirth = $_POST["dateOfBirth"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $profilepic = "";

        if (strlen($password) < 8) {
            $templateParams["erroreRegistrazione"] = "Password must be at least 8 characters long!";
        } else if (isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"])) {
            // $_FILES["profilepic"] è definito e contiene un nome di file non vuoto
            list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["profilepic"]);
        
            if ($result != 0) {
                $profilepic = $msg;

                $registration_result = $dbh->registerUser($name, $surname, $username, $password, $dateOfBirth, $gender, $email, $profilepic);

                if (!$registration_result) {
                    $templateParams["erroreRegistrazione"] = "Errore durante la registrazione. Riprova!";
                    /*header("Location: register.php");
                    exit();*/
                } else {
                    registerLoggedUser($registration_result);
                }
        
            } else {
                header("location: register.php?formmsg=" . $msg);
            }
        } else {
            $templateParams["erroreRegistrazione"] = "Errore: Nessun file caricato o file non valido.";
            header("location: register.php?formmsg=" . $templateParams["erroreRegistrazione"]);
        }

    }

    if(isUserLoggedIn()){
        $templateParams["title"] = "Home";
        $templateParams["name"] = "home.php";
        $templateParams["username"] = $_SESSION["username"];
        $templateParams["profilepic"] = $profilepic;
        header("Location: home.php");
        exit();
    }
    else{
        $templateParams["title"] = "Register";
        require("template/register-form.php");
    }

?>