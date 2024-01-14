<main id="profile-main">
        <div id="profile-container">
            <div id="profile-info">
                <div class="profile-pic-container">
                    <img src="img/outfit.jpeg" alt="Profile Picture" />
                </div>
                <p>@username</p>
                <div id="profile-stats">
                    <span class="stat-item">
                        <span>21</span><br>
                        <span>Post</span>
                      </span>
                    <span class="stat-item">
                        <span>1024</span><br>
                        <a data-bs-toggle="modal" data-bs-target="#modalFollow" id="showFollowers" href="#">Followers</a>
                    </span>
                    <span class="stat-item">
                        <span>2k</span><br>
                        <a data-bs-toggle="modal" data-bs-target="#modalFollow" id="showFollowings" href="#">Followings</a>
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
            <div class="modal-body">
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
                </div>
                <div class="userContainer">
                    <span class="profile-pic-container"><img src="img/logo.png" alt="profile picture"></span>
                    <p>@username</p>
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