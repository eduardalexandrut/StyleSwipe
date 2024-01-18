document.getElementById('posts-icon').addEventListener('click', function() {
    document.getElementById('posts-grid').classList.remove('hidden');
    document.getElementById('saved-grid').classList.add('hidden');
    document.getElementById('posts-icon').classList.add('active');
    document.getElementById('saved-icon').classList.remove('active');
});

document.getElementById('saved-icon').addEventListener('click', function() {
    document.getElementById('posts-grid').classList.add('hidden');
    document.getElementById('saved-grid').classList.remove('hidden');
    document.getElementById('posts-icon').classList.remove('active');
    document.getElementById('saved-icon').classList.add('active');
});

document.getElementById('showFollowers').addEventListener('click', function() {
    $('#modalFollow .modal-body').addClass('initially-hidden');
    $('#modalFollow').on('shown.bs.modal', function () {
        document.getElementById('followings').style.display = 'none';
        document.getElementById('followers').style.display = 'block';
        document.getElementsByClassName('modalTitle')[0].textContent = 'Followers';
        $('#modalFollow .modal-body').removeClass('initially-hidden');
    }).modal('show');
});

document.getElementById('showFollowings').addEventListener('click', function() {
    $('#modalFollow .modal-body').addClass('initially-hidden');
    $('#modalFollow').on('shown.bs.modal', function () {
        document.getElementById('followings').style.display = 'block';
        document.getElementById('followers').style.display = 'none';
        document.getElementsByClassName('modalTitle')[0].textContent = 'Followings';
        $('#modalFollow .modal-body').removeClass('initially-hidden');
    }).modal('show');
});

function toggleFollow(profileUsername) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('followButton').innerText = this.responseText;
        }
    };
    xhttp.open("GET", "toggle_follow.php?profile=" + profileUsername, true);
    xhttp.send();
}

document.addEventListener('DOMContentLoaded', function() {
    let followersContainers = document.querySelectorAll("#followers .userContainer");
    let followingsContainers = document.querySelectorAll("#followings .userContainer");

    if (followersContainers.length > 0) {
        followersContainers[followersContainers.length - 1].classList.add = "lastUserContainer";
    }
    
    if (followingsContainers.length > 0) {
        followingsContainers[followingsContainers.length - 1].classList.add = "lastUserContainer";
    }
});

document.addEventListener('DOMContentLoaded', function () {

    let postElements = document.querySelectorAll('.profile-post');

    postElements.forEach(function (post) {
        post.addEventListener('click', function () {
            showPostModal(post);
        });
    });

    function showPostModal(postElement) {
        let postImage = postElement.dataset.postImage;
        let postUsername = postElement.dataset.postUsername;
        let postComment = postElement.dataset.postComment;
        let postDate = postElement.dataset.postDate;
        let postProfilePic = postElement.dataset.postProfilepic;

        document.getElementById('postImage').src = postImage;
        document.getElementById('postUsername').textContent = '@' + postUsername;
        document.getElementById('postCaption').textContent = postComment;
        document.getElementById('postDate').textContent = postDate;
        document.getElementById('profilePicPost').src = postProfilePic;

        document.getElementById('viewPostDetailLink').addEventListener('click', function() {
            let postId = postElement.dataset.postId;
            let detailPageUrl = 'post-detail.php?postId=' + encodeURIComponent(postId);
            window.location.href = detailPageUrl;
        })

        new bootstrap.Modal(document.getElementById('postModal')).show();
    }
});
