<main id="profile-main">
        <div id="profile-container">
            <div id="profile-info">
                <div class="profile-pic-container">
                    <img src="<?php echo UPLOAD_DIR.$templateParams["profilepic"]; ?>" alt="Profile Picture" />
                </div>
                <p><?php echo $templateParams["username"]; ?></p>
                <?php
                    if (isset($_SESSION['username']) && $_SESSION['username'] !== $templateParams['username']) {
                        $isFollowing = $templateParams["isFollowing"];
                        $buttonText = $isFollowing ? 'Unfollow' : 'Follow';
                ?>
                <button id="followButton" onclick="toggleFollow('<?php echo $templateParams['username']; ?>')"><?php echo $buttonText; ?></button>
                <?php } ?>

                <div id="profile-stats">
                    <span class="stat-item">
                        <span class="stat-item-num"><?php echo $templateParams["numPosts"]; ?></span><br>
                        <span class="stat-item-desc">Post</span>
                      </span>
                    <span class="stat-item">
                        <span class="stat-item-num"><?php echo $templateParams["numFollowers"]; ?></span><br>
                        <a data-bs-toggle="modal" data-bs-target="#modalFollow" id="showFollowers" class="stat-item-desc" href="#">Followers</a>
                    </span>
                    <span class="stat-item">
                        <span class="stat-item-num"><?php echo $templateParams["numFollowings"]; ?></span><br>
                        <a data-bs-toggle="modal" data-bs-target="#modalFollow" id="showFollowings" class="stat-item-desc" href="#">Followings</a>
                    </span>
                </div>
            </div>
            <div id="switch-container">
                <i id="posts-icon" class="fas fa-tshirt icon active"></i>
                <i id="saved-icon" class="fas fa-star icon"></i>
            </div>
            <div>
                <div id="posts-grid" class="grid">
                    <!-- Griglia per post pubblicati-->
                    <div class="profile-post" onclick="showPost(this)">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                    <div class="profile-post">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                    <div class="profile-post">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                    <div class="profile-post">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                    <div class="profile-post">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                    <div class="profile-post">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                    <div class="profile-post">
                        <img src="img/outfit.jpeg" alt="Post Image">
                    </div>
                </div>
                <div id="saved-grid" class="grid hidden">
                    <!-- Griglia per post salvati -->
                </div>
            </div>
        </div>
    </main><aside class="notificationAside">
        <h3>Notifications:</h3>
            <?php
                // Check if the displayNotifications function is defined
                if (function_exists('displayNotifications')) {
                    // Call the displayNotifications function with the notifications data
                    displayNotifications($templateParams["notifications"]);
                }
            ?>
        
    </aside>

    <!--Notifications Modal-->
    <div class="modal fade" id="notifyModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class=" modal-content">
                <div class="modal-header">
                    <h2>Notifications</h2>
                    <button data-bs-dismiss="modal">
                        <i class="bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        // Check if the displayNotifications function is defined
                        if (function_exists('displayNotifications')) {
                            // Call the displayNotifications function with the notifications data
                            displayNotifications($templateParams["notifications"]);
                        }
                    ?>
            </div>
        </div>
    </div>
     </div>

    <!--Followers/Followings Modal-->
    <div id="modalFollow" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
                <!--Codice php per mostrare Followers o Followings a seconda del tasto cliccato-->
                <p class="modalTitle">Followers</p>
                <button data-bs-dismiss="modal">
                    <i class="bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body initially-hidden">
                <div id="followers">
                <?php
                    $users = $templateParams['followers'];
                    if (empty($users)) {
                        echo '<p>Nessun utente trovato.</p>';
                    } else {
                        foreach ($users as $user) : ?>
                            <a href="profile.php?username=<?php echo $user['username']; ?>">
                            <div class="userContainer">
                                <span class="profile-pic-container"><img src="<?php echo UPLOAD_DIR.$user['profile_image']; ?>" alt="profile picture"></span>
                                <p>@<?php echo $user['username']; ?></p>
                            </div>
                            </a>
                        <?php endforeach;
                    } 
                ?>
                </div>
                <div id="followings">
                <?php
                    $users = $templateParams['followings'];
                    if (empty($users)) {
                        echo '<p>Nessun utente trovato.</p>';
                    } else {
                        foreach ($users as $user) : ?>
                        <a href="profile.php?username=<?php echo $user['username']; ?>">
                            <div class="userContainer">
                                <span class="profile-pic-container"><img src="<?php echo UPLOAD_DIR.$user['profile_image']; ?>" alt="profile picture"></span>
                                <p>@<?php echo $user['username']; ?></p>
                            </div>
                        </a>
                        <?php endforeach;
                    } 
                ?>
                </div>
            </div>
          </div>
        </div>
    </div>

    <!--
        Post Modal
    -->
    <div id="postModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
                <button data-bs-dismiss="modal">
                    <i class="bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <img id="postImage" src="" alt="Post Image" class="img-fluid"/>
            </div>
            <div class="modal-footer">
                <p id="postUsername">@username</p>
                <p id="postCaption">Lorem ipsum dolor sit amet, consectetur adipisci elit, sed do eiusmod tempor incidunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
        </div>
    </div>

    <?php require("template/search.html"); ?>

    <script src="js/open-search.js"></script>
    <script src="js/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>