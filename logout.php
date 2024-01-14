<?php
    session_start();
    session_destroy(); 

    $templateParams[] = "";

    header("Location: login.php"); 
    exit();
?>
