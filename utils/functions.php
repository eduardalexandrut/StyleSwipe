<?php

function isUserLoggedIn(){
    return !empty($_SESSION['id']);
}
function registerLoggedUser($user){
    $_SESSION["id"] = $user["id"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["surname"] = $user["surname"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["date_of_birth"] = $user["date_of_birth"];
    $_SESSION["gender"] = $user["gender"];
}

?>