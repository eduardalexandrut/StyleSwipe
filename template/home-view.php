<main id="homeMain">
        <!--Post Structure-->
        <div class="post">
            <header>
                <img alt="User Profile Pic" src="img/outfit.jpeg" />
                <a href="profile.html">@username</a>
                <p>22 Jul 2024</p>
            </header>
            <img alt="Outfit Pic" src="img/outfit.jpeg" />
            <canvas></canvas>
            <section>
                <div>
                    <div>
                        <button>
                            <i class="bi-hand-thumbs-up"></i>
                        </button>
                        <p>1.2k</p>
                    </div>
                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#commentsModal">
                            <i class="bi-cloud"></i>
                        </button>
                        <p>300</p>
                    </div>
                    <div>
                        <button>
                            <i class="bi-star"></i>
                        </button>
                        <p>143</p>
                    </div>
                </div>
            </section>
            <footer>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem qui facilis, et molestiae tempore magnam, consequatur tenetur saepe magni quae, expedita eius laborum at. Dolor maxime odit dolore amet odio.</p>
            </footer>
        </div>

        <!--Post Structure-->
        <div class="post">
            <header>
                <img alt="User Profile pic" src="img/outfit.jpeg" />
                <a href="profile.html">@username</a>
                <p>22 Jul 2024</p>
            </header>
            <img alt="Outfit Pic" src="img/outfit.jpeg" />
            <canvas></canvas>
            <section>
                <div>
                    <div>
                        <button>
                            <i class="bi-hand-thumbs-up"></i>
                        </button>
                        <p>1.2k</p>
                    </div>
                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#commentsModal">
                            <i class="bi-cloud"></i>
                        </button>
                        <p>300</p>
                    </div>
                    <div>
                        <button>
                            <i class="bi-star"></i>
                        </button>
                        <p>143</p>
                    </div>
                </div>
            </section>
            <footer>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem qui facilis, et molestiae tempore magnam, consequatur tenetur saepe magni quae, expedita eius laborum at. Dolor maxime odit dolore amet odio
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem qui facilis, et molestiae tempore magnam, consequatur tenetur saepe magni quae, expedita eius laborum at. Dolor maxime odit dolore amet odio.</p>
            </footer>
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
                    <div class="comment">
                        <img alt="User Profile Pic" src="img/logo.png">
                        <section>
                            <header>
                                <a href="profile.html">@username</a>
                                <p>24/1/2012</p>
                            </header>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores minima enim maiores dicta animi, voluptate blanditiis perferendis quo voluptates quam veritatis eveniet architecto corporis pariatur magni. Provident unde eaque hic.</p>
                        </section>
                    </div>

                    <div class="comment">
                        <img alt="User Profile Pic" src="img/logo.png">
                        <section>
                            <header>
                                <a href="profile.html">@username</a>
                                <p>24/1/2012</p>
                            </header>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores minima enim maiores dicta animi, voluptate blanditiis perferendis quo voluptates quam veritatis eveniet architecto corporis pariatur magni. Provident unde eaque hic.</p>
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="input-group">
                        <input type="text" name="comment" class="form-control" placeholder="Add a comment..." aria-label="Add a comment..." aria-describedby="button-addon2">
                        <button class="btn" type="button" id="button-addon2">Add</button>
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
    <?php require("template/search.php"); ?>
    <script src= "js/home-view.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      