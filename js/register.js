
document.getElementById('profile-pic').addEventListener('change', function(e) {
    var reader = new FileReader();
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


