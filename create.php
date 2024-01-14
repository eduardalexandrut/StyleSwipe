<?php
require_once 'bootstrap.php';

$templateParams["title"] = "New Outfit";
$templateParams["name"] = "create-view.php";
$templateParams["profilepic"] = $_SESSION["profilepic"];
$templateParams["username"] = $_SESSION["username"];

//Check if the request methos is of type POST.
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Check if comment and items are set in $_POST
    if (isset($_POST['items'], $_FILES['image'])) {
        $comment = $_POST['comment'];
        $items = json_decode($_POST['items'], true);
        list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES['image']);//Upload post image to the folder.

        // Check if JSON decoding was successful
        if ($items === null) {
            echo "Error decoding JSON data.";
        } else {
            //If image gets uploaded succesfully to the folder, create post. 
            if ($result != 0) {
                $image = $msg;
                $user = $_SESSION["username"];
                $postId = $dbh->createPost($user, $comment, $image);
    
                //If post was created succesfully, crate items.
                if ($postId != null) {
                    if (is_array($items)) {
                        foreach ($items as $item) {
                            $dbh->createItem($postId, $item['name'], $item['brand'], $item['link'], $item['size'], $item['price'], $item['x'], $item['y']);
                        }
                    }
                } else {
                    echo "Error creating post.";
                }
            } else {
                header("location: register.php?formmsg=" . $msg);
            }
        }
    } else {
        echo "Incomplete data received.";
    }
}

require 'template/base.php';
?>