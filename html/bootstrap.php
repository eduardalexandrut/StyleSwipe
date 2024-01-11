<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "styleswipe", 3306);
define("UPLOAD_DIR", "../img/")
?>