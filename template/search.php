<?php
require_once '../bootstrap.php';

if(isset($_POST["query"])) {
    $output = '';
    $result = $dbh->searchUser($_POST["query"]);
    $output = '<div class="list-unstyled">';
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output .= '<a href="profile.php?username='.$row["username"].'">
                            <div class="userContainer">
                                <span class="profile-pic-container"><img src="'.UPLOAD_DIR.$row["profile_image"].'" alt="profile picture"></span>
                                <p>@'.$row["username"].'</p>
                            </div>
                        </a>';
        }
    } else {
        $output .= '<p>User not found</p>';
    }
    $output .= '</div>';
    echo $output;
}

?>