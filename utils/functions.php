<?php

function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " data-name='active' ";
    }
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}
function registerLoggedUser($user){
    $_SESSION["name"] = $user["name"];
    $_SESSION["surname"] = $user["surname"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["date_of_birth"] = $user["date_of_birth"];
    $_SESSION["gender"] = $user["gender"];
}

?>