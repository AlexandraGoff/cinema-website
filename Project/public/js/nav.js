let mainNav = document.getElementsByClassName("js-menu");
let navBarToggle = document.getElementById("js-nav-toggle");
navBarToggle.addEventListener("click", function() {
    mainNav.classList.add("active-nav");
});