<?php
require_once 'bootstrap.php';
require 'notifications.php';

$templateParams["name"] = "home-view.php";
$templateParams["title"] = "Home";
$templateParams["post"] = $dbh->getPostsOfFollowing($_SESSION["username"]);
$templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);

//displayNotifications($templateParams["notifications"]);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //Check if post-id is provided.
    if(isset($_GET["update"]) && $_GET["update"] == "True") {
        foreach($templateParams["notifications"] as $notify) {
            if ($notify["seen"] == 0) {
                //set to seen.
                $dbh->setNotificationToSeen($notify["id"]);
            }
        }
        $notifications = $dbh->getNotifications($_SESSION["username"]);
        
        //Transform response into JSON.
        $response = [
            "notifications" => $notifications
        ];
        //$templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    else if (isset($_GET["postId"])) {
        $postId = $_GET["postId"];
        //Get comments.
        $comments = $dbh->getCommentsOfPost($postId);
        
        //Transform response into JSON.
        $response = [
            'comments' => $comments
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        /*header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'postId not provided']);
        exit;*/
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