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
    document.getElementsByClassName('modalTitle')[0].textContent = 'Followers';
});

document.getElementById('showFollowings').addEventListener('click', function() {
    document.getElementsByClassName('modalTitle')[0].textContent = 'Followings';
});

function showPost(post) {
    document.getElementById('postImage').src = post.querySelector('img').src;
    /*document.getElementById('postUsername').textContent = post.querySelector('.username').textContent;
    document.getElementById('postCaption').textContent = post.querySelector('.caption').textContent;*/
    new bootstrap.Modal(document.getElementById('postModal')).show();
}