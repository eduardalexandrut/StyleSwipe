const UPLOAD_DIR = "upload/";

//Event listener for refresh notify button.
document.querySelectorAll("button.refresh-notify").forEach((btn) => btn.addEventListener("click", ()=>updateNotifications(), false));

       //Function to update notifications.
       function updateNotifications() {
        //GET requests to get the comments of the specific post.
        fetch(`./create.php?update=True`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Network response was not ok");
            }
        })
        .then(data => {
            const notifyContainer = document.querySelectorAll('.notifyContainer');
            notifyContainer.forEach(e=>e.innerHTML="");

            if (data.notifications.length == 0) {
                notifyContainer.forEach(e=>e.innerHTML="<p>No notifications yet.</p>");
            } else {
                data.notifications.forEach((notification) => {
                    let notificationDiv = document.createElement('div');
                    notificationDiv.classList.add("notification");
                    notificationDiv.innerHTML =`
                    <img alt="User Profile Pic" src="${UPLOAD_DIR}${notification['from_user_profile_pic']}"/>
                    <!-- The notification hasn't been seen -->
                    ${notification['seen'] == 0 ? `<span class="notify-badge badge rounded-pill bg-primary">New</span>` : ''}
                
                    <p class="notification-text">
                        <span class="notify-user">
                            <a href="profile.php?username=${notification['from_user_username']}">
                                ${notification['from_user_username']}
                            </a>
                        </span>
                
                        <!-- Conditional rendering based on notification type -->
                        ${
                            notification['notification_type'] === 'liked'
                                ? `<a class="notify-liked" href="#">Liked</a> your post.`
                                : notification['notification_type'] === 'commented'
                                ? `<a class="notify-commented" href="#">Commented</a> your post.`
                                : `<a class="notify-stared" href="#">Starred</a> your post.`
                        }
                
                        <span class="notify-time">${calculate_days(notification['date_posted'])}</span>
                    </p>
            `;
                    notifyContainer.forEach(e => e.appendChild(notificationDiv.cloneNode(true)));
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    //Function to calculate days passed between 2 days.
    function calculate_days(date) {
        let startDate = new Date(date);

        let currentDate = new Date();

        //Number of milliseconds passed.
        let timePassed = currentDate - startDate;

        let numOfDays = Math.floor(timePassed/(1000 *60 * 60 * 24));

        if (numOfDays < 1) {
            return 'Today';
        } else if (numOfDays == 1) {
            return `${numOfDays} day ago.`;
        } else {
            return `${numOfDays} days ago.`;
        }

    }