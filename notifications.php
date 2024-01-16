<?php
function displayNotifications($notifications) {
?>
    <?php foreach ($notifications as $notification): ?>
        <!-- New Notification element. -->
        <div class="notification">
            <img alt="User Profile Pic" src="<?php echo UPLOAD_DIR . $notification["from_user_profile_pic"] ?>" />
            <!-- The notification hasn't been seen -->
            <?php if ($notification['seen'] == 0): ?>
                <span class="notify-badge badge rounded-pill bg-primary">New</span>
            <?php endif; ?>
            <!-- The notification is of type liked -->
            <?php if ($notification['notification_type'] == 'liked'): ?>
                <p>
                    <span class="notify-user">
                        <a href="<?php echo "profile.php?=".$notification['from_user_username']?>">
                        <?php echo $notification['from_user_username']?>
                        </a>
                    </span>
                    <a class="notify-liked" href="#">Liked</a> your post.
                    <span class="notify-time"><?php echo $notification["date_posted"] ?></span>
                </p>
            <!-- The notification is of type commented -->
            <?php elseif ($notification['notification_type'] == 'commented'): ?>
                <p>
                    <span class="notify-user">
                        <a href="profile.html"><?php echo $notification["from_user_username"] ?></a>
                    </span>
                    <a class="notify-commented" href="#">Commented</a> your post.
                    <span class="notify-time">2h ago</span>
                </p>
            <!-- The notification is of type starred -->
            <?php else: ?>
                <p>
                    <span class="notify-user">
                        <a href="profile.html"><?php echo $notification["from_user_username"] ?></a>
                    </span>
                    <a class="notify-stared" href="#">Starred</a> your post.
                    <span class="notify-time">2h ago</span>
                </p>
            <?php endif; ?>
        </div>
    <?php endforeach;
}
?>
