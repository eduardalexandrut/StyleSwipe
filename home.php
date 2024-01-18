<?php
require_once 'bootstrap.php';
require 'notifications.php';

$templateParams["name"] = "home-view.php";
$templateParams["title"] = "Home";
$templateParams["post"] = $dbh->getPostsOfFollowing($_SESSION["username"]);
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
        //$_SESSION['count']++;
        //Transform response into JSON.
        $response = [
            "notifications" => $notifications
        ];
        //$templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    else if (isset($_GET["postId"]) && isset($_GET["action"])) {
        $postId = $_GET["postId"];
        //Retrieve comments.
        if ($_GET["action"] == "COMMENTS") {
            //Get comments.
            $comments = $dbh->getCommentsOfPost($postId);
            
            //Transform response into JSON.
            $response = [
                'comments' => $comments
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
            
        } else if ($_GET["action"] == "ITEMS") {
            // Get items.
            $items = $dbh->getItemsOfPost($postId);
        
            $response = [
                'items' => $items
            ];
        
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        
       
    } 
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //Get content from input.
    $json_data = file_get_contents('php://input');
    // Decode JSON data
    $data = json_decode($json_data, true);
    
    // Check if action and post_id are set.
    if (isset($data['action'], $data['postId'])) {
        $action = $data['action'];
        $postId = $data['postId'];
        $to_user = $dbh->getPostOwner($postId);
        
        //Check type of action.
        if ($action == "LIKE") {
            $dbh->addLike($postId, $_SESSION["username"]);
            //Generate notification.
            if ($to_user) {
                $dbh->addNotification($postId,$_SESSION["username"], $to_user, 'liked');
            }
        } else if ($action == "UNLIKE") {
            $dbh->removeLike($postId, $_SESSION["username"]);
        } else if ($action == "STAR") {
            $dbh->addStar($postId, $_SESSION["username"]);
            //Generate notification.
            if ($to_user) {
                $dbh->addNotification($postId,$_SESSION["username"], $to_user, 'starred');
            }
        } else if ($action == "UNSTAR") {
            $dbh->removeStar($postId, $_SESSION["username"]);
        } else if ($action == "COMMENT") {
            if(isset($data["comment_text"])) {
                $body = $data["comment_text"];
                $dbh->addComment($postId, $_SESSION["username"], $body);
                //Generate notification.
                if ($to_user) {
                    $dbh->addNotification($postId,$_SESSION["username"], $to_user, 'commented');
                }
            } else {
                echo "Missing comment_text";
            }
            //Generate notification.
            
        }
    } else {
        // Missing action or post_id.
        echo "Missing argument";
    }
    
}

require 'template/base.php';
?>