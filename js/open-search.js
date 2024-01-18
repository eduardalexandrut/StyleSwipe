function openNav() {
    document.querySelector('body').style.overflow = "hidden";
    document.querySelector('nav').style.display = "none";
    if (window.matchMedia("(min-width: 768px)").matches) {
        document.getElementById("search-sidebar").style.width = "40%";
    } else {
        document.getElementById("search-sidebar").style.width = "90%";
    }
    document.getElementById("overlay").style.display = "block";
}

function closeNav() {
    document.querySelector('body').style.overflow = "scroll";
    document.querySelector('nav').style.display = "flex";
    document.getElementById("search-sidebar").style.width = "0%";
    document.getElementById("overlay").style.display = "none";
}
