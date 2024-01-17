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
                <div id="posts-grid" class="grid <?php echo (empty($templateParams["publishedPosts"])) ? 'no-posts-found' : ''; ?>">
                <?php if (!empty($templateParams["publishedPosts"])) : ?>
                    <?php foreach ($templateParams["publishedPosts"] as $post) : ?>
                        <div class="profile-post" 
                            data-post-username="<?php echo $post['user_username']; ?>"
                            data-post-image="<?php echo UPLOAD_DIR.$post['image']; ?>"
                            data-post-comment="<?php echo $post['comment']; ?>"
                            data-post-date="<?php echo calculate_days($post['posted']) ?>"
                            data-post-profilePic="<?php echo UPLOAD_DIR.$templateParams["profilepic"] ?>"
                        >
                            <img src="<?php echo UPLOAD_DIR.$post['image']; ?>" alt="Post Image">
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-posts">
                    <i class="bi bi-card-image"></i> No posts found.
                    </p>
                <?php endif; ?>
                </div>
                <div id="saved-grid" class="grid hidden <?php echo (empty($templateParams["starredPosts"])) ? 'no-posts-found' : ''; ?>">
                    <?php if (!empty($templateParams["starredPosts"])) : ?>
                        <?php foreach ($templateParams["starredPosts"] as $post) : ?>
                            <div class="profile-post" 
                                data-post-username="<?php echo $post['user_username']; ?>"
                                data-post-image="<?php echo UPLOAD_DIR.$post['image']; ?>"
                                data-post-comment="<?php echo $post['comment']; ?>"
                                data-post-date="<?php echo calculate_days($post['posted']) ?>"
                                data-post-profilePic="<?php echo UPLOAD_DIR.$post["user_profile_image"] ?>"
                            >
                                <img src="<?php echo UPLOAD_DIR.$post['image']; ?>" alt="Post Image">
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="no-posts">
                        <i class="bi bi-card-image"></i> No posts found.
                        </p>
                    <?php endif; ?>
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
                <img src="" alt="Profile Picture" id="profilePicPost"/>
                <p id="postUsername"></p>
                <p id="postDate"></p>
                <button data-bs-dismiss="modal">
                    <i class="bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <img id="postImage" src="" alt="Post Image" class="img-fluid"/>
            </div>
            <div class="modal-footer">
                <div class="modal-footer-header" >

                </div>
                <p id="postCaption"></p>
            </div>
          </div>
        </div>
    </div>

    <?php require("template/search.html"); ?>

    <script src="js/open-search.js"></script>
    <script src="js/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>