
document.getElementById('profile-pic').addEventListener('change', function(e) {
    let reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('selected-image').src = e.target.result;
        document.getElementById('selected-image').style.display = 'block';
        document.getElementById('profile-pic-icon').children[0].style.display = 'none'; // Nasconde l'icona SVG
        document.getElementById('profile-pic-icon').style.background = 'none';
        document.getElementById('profile-pic-icon').style.padding = 0;
    }
    reader.readAsDataURL(this.files[0]);
}, false);

// Quando la pagina viene caricata, nasconde l'immagine
window.onload = function(e) {
    document.getElementById('selected-image').style.display = 'none';
}

document.getElementById('password').addEventListener("input", function() {
    const password = this.value;

    if (password.length < 8) {
        this.classList.remove('valid-password');
        this.classList.add('invalid-password');
        document.getElementById("password-message").innerText = "Password must be at least 8 characters long";
        document.getElementById("password-message").style.color = "red";

    } else {
        this.classList.remove('invalid-password');
        this.classList.add('valid-password');
        document.getElementById("password-message").innerText = "ok";
        document.getElementById("password-message").style.color = "green";
    }
})
