<?php
if (!isset($_SESSION)) {
    session_start();
}
define("UPLOAD_DIR", "upload/");
require_once("db/database.php");
require_once 'utils/functions.php';
$dbh = new DatabaseHelper("localhost", "root", "", "styleswipe", 3306);
?>