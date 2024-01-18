<?php
require_once 'bootstrap.php';
require 'notifications.php';

$templateParams["title"] = "New Outfit";
$templateParams["name"] = "create-view.php";
$templateParams["profilepic"] = $_SESSION["profilepic"];
$templateParams["username"] = $_SESSION["username"];
$templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);

// Initialize $count to 0 if it doesn't exist in the session
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}

$notifications = $dbh->getNotifications($_SESSION["username"]);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //Check if post-id is provided.
    if(isset($_GET["update"]) && $_GET["update"] == "True") {
        //Not the first request.
        if ($_SESSION['count'] > 0) {
            $old_notifications = [...$notifications];
            foreach($old_notifications as $notify) {
                if ($notify["seen"] == 0) {
                    //set to seen.
                    $dbh->setNotificationToSeen($notify["id"]);
                }
            }
            $notifications = $dbh->getNotifications($_SESSION["username"]);
            
        } else {
            $notifications = $dbh->getNotifications($_SESSION["username"]);
        }
        $_SESSION['count']++;
        //Transform response into JSON.
        $response = [
            "notifications" => $notifications
        ];
        //$templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

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