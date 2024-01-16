<main id="homeMain">
        <!--Post Structure-->
        
        <?php if (count($templateParams["post"]) == 0): ?>
            <p>No following.</p>
        <?php else: foreach ($templateParams["post"] as $post): ?>
           <div class="post" data-post-id = "<?php echo $post['id'] ?>">
        <header>
            <img alt="User Profile Pic" src="./upload/be.jpeg" />
            <a href="profile.html"><?php echo $post['user_username']; ?></a>
            <p><?php echo $post['posted']; ?></p>
        </header>
        <img alt="Outfit Pic" src="<?php echo UPLOAD_DIR.$post['image']; ?>" />
        <canvas></canvas>
        <section>
            <div>
                <div>
                    <?php if (in_array($_SESSION["username"], explode(',', $post["liked_by"]))): ?>
                        <!-- User has liked the post -->
                        <button data-action="UNLIKE" data-post-id="<?php echo $post['id'] ?>" class="like-btn">
                            <i class="bi-hand-thumbs-down"></i>
                        </button>
                    <?php else: ?>
                        <!-- User has not liked the post -->
                        <button data-action="LIKE" data-post-id="<?php echo $post['id'] ?>" class="like-btn">
                            <i class="bi-hand-thumbs-up"></i>
                        </button>
                    <?php endif; ?>
                    <p><?php echo $post["likes"] ?></p>
                </div>
                <div>
                    <button data-bs-toggle="modal" data-bs-target="#commentsModal" data-post-id="<?php echo $post['id'] ?>" class = "comment-btn">
                        <i class="bi-cloud"></i>
                    </button>
                    <p><?php echo $post["comments"] ?></p>
                </div>
                <div>
                    <?php if (in_array($_SESSION["username"], explode(',', $post["starred_by"]))): ?>
                        <!--User has starred the post-->
                        <button data-action = "UNSTAR" data-post-id="<?php echo $post['id'] ?>" class="star-btn">
                            <i class="bi-star-fill"></i>
                        </button>
                        <!-- User hasn't starred the post.-->
                    <?php else:?>
                        <button data-action = "STAR" data-post-id="<?php echo $post['id'] ?>" class="star-btn">
                            <i class="bi-star"></i>
                        </button>
                    <?php endif; ?>
                    <p><?php echo $post["stars"] ?></p>
                </div>
            </div>
        </section>
        <footer>
            <p><?php echo $post['comment']; ?></p>
        </footer>
    </div>
     <?php endforeach; ?>
     <?php endif; ?>
    </main><aside class="notificationAside"> 
        <h3>Notifications:</h3>
        <!--New Notification element.-->
        <div class="notification">
            <img alt="User Profile Pic" src="img/outfit.jpeg" />
            <span class="notify-badge badge rounded-pill bg-primary">New</span>
            <p><span class="notify-user"><a href="profile.html">@username</a></span> <a class="notify-liked" href="#">Liked</a> your post. <span class="notify-time">2h ago</span></p>
        </div>

        <!--Notification element.-->
        <div class="notification">
            <img alt="User Profile Pic" src="img/outfit.jpeg" />
            <p><span class="notify-user"><a href="profile.html">@username</a></span> <a class="notify-stared" href="#">Starred</a> your post. <span class="notify-time">2h ago</span></p>
        </div>

        <!--Notification element.-->
        <div class="notification">
            <img alt="User Profile Pic" src="img/outfit.jpeg" />
            <p><span class="notify-user"><a href="profile.html">@username</a></span> <a class="notify-commented" href="#">Commented</a> your post. <span class="notify-time">2h ago</span></p>
        </div>
    </aside>
    <!--Comments Modal-->
    <div class="modal fade" id="commentsModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Comments</h3>
                    <button data-bs-dismiss="modal">
                        <i class="bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                   
                </div>
                <div class="modal-footer">
                    <div class="input-group">
                        <input type="text" name="comment" class="form-control" placeholder="Add a comment..." aria-label="Add a comment..." aria-describedby="button-addon2">
                        <button class="btn" type="button" id="button-addon2" data-action = "COMMENT" data-bs-dismiss="modal">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <!--New Notification element.-->
                    <div class="notification">
                        <img alt="User Profile Pic" src="img/outfit.jpeg" />
                        <span class="notify-badge badge rounded-pill bg-primary">New</span>
                        <p><span class="notify-user"><a href="profile.html">@username</a></span> <a class="notify-liked" href="#">Liked</a> your post. <span class="notify-time">2h ago</span></p>
                    </div>

                    <!--Notification element.-->
                    <div class="notification">
                        <img alt="User Profile Pic" src="img/outfit.jpeg" />
                        <p><span class="notify-user"><a href="profile.html">@username</a></span> <a class="notify-stared" href="#">Starred</a> your post. <span class="notify-time">2h ago</span></p>
                    </div>

                    <!--Notification element.-->
                    <div class="notification">
                        <img alt="User Profile Pic" src="img/outfit.jpeg" />
                        <p><span class="notify-user"><a href="profile.html">@username</a></span> <a class="notify-commented" href="#">Commented</a> your post. <span class="notify-time">2h ago</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Outfit Item Info Modal-->
    <div class="modal fade" id="itemInfoModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Item Info</h2>
                    <button data-bs-dismiss="modal">
                        <i class="bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                   
                </div>
            </div>
        </div>
    </div>
    <?php require("template/search.html"); ?>

    <script src="js/open-search.js"></script>
    <script src= "js/home-view.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      