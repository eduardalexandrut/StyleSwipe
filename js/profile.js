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

function showPost(post) {
    document.getElementById('postImage').src = post.querySelector('img').src;
    /*document.getElementById('postUsername').textContent = post.querySelector('.username').textContent;
    document.getElementById('postCaption').textContent = post.querySelector('.caption').textContent;*/
    new bootstrap.Modal(document.getElementById('postModal')).show();
}

function toggleFollow(profileUsername) {
    // Esegui una richiesta AJAX per gestire il toggle di seguimento
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Aggiorna il testo del pulsante in base alla risposta del server
            document.getElementById('followButton').innerText = this.responseText;
        }
    };
    xhttp.open("GET", "toggle_follow.php?profile=" + profileUsername, true);
    xhttp.send();
}

document.addEventListener('DOMContentLoaded', function () {

    let postElements = document.querySelectorAll('.profile-post');

    postElements.forEach(function (post) {
        post.addEventListener('click', function () {
            showPostModal(post);
        });
    });

    function showPostModal(postElement) {
        // Recupera i dati relativi al post dal DOM
        let postImage = postElement.dataset.postImage;
        let postUsername = postElement.dataset.postUsername;
        let postComment = postElement.dataset.postComment;
        let postDate = postElement.dataset.postDate;
        let postProfilePic = postElement.dataset.postProfilepic;

        // Ora puoi utilizzare questi dati per popolare il modal
        document.getElementById('postImage').src = postImage;
        document.getElementById('postUsername').textContent = '@' + postUsername;
        document.getElementById('postCaption').textContent = postComment;
        document.getElementById('postDate').textContent = postDate;
        document.getElementById('profilePicPost').src = postProfilePic;

        // Mostra il modal
        new bootstrap.Modal(document.getElementById('postModal')).show();
    }
});
