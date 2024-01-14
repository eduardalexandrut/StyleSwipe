<?php
require_once 'bootstrap.php';

$templateParams["title"] = "New Outfit";
$templateParams["name"] = "create-view.php";
$templateParams["profilepic"] = $_SESSION["profilepic"];
$templateParams["username"] = $_SESSION["username"];


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Check if comment and items are set in $_POST
    if (isset($_POST['comment'], $_POST['items'])) {
        $comment = $_POST['comment'];
        $items = json_decode($_POST['items'], true);

        // Check if JSON decoding was successful
        if ($items === null) {
            echo "Error decoding JSON data.";
        } else {
            $user = $_SESSION["username"];
            $postId = $dbh->createPost($user, $comment);

            if ($postId) {
                if (is_array($items)) {
                    foreach ($items as $item) {
                        $dbh->createItem($postId, $item['name'], $item['brand'], $item['link'], $item['size'], $item['price'], $item['x'], $item['y']);
                    }
                }
            } else {
                echo "Error creating post.";
            }
        }
    } else {
        echo "Incomplete data received.";
    }
}

require 'template/base.php';
?>