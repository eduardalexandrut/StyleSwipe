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

            list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["profilepic"]);
        
            if ($result != 0) {
                $profilepic = $msg;

                $registration_result = $dbh->registerUser($name, $surname, $username, $password, $dateOfBirth, $gender, $email, $profilepic);

                if (!$registration_result) {
                    $templateParams["erroreRegistrazione"] = "Error during registration. Please try again!";
                } else {
                    registerLoggedUser($registration_result);
                }
        
            } else {
                header("location: register.php?formmsg=" . $msg);
            }
        } else {
            $templateParams["erroreRegistrazione"] = "Error: No file uploaded or invalid file.";
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