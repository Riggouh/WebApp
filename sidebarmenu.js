function toggleMenu() {
    var sidebar = document.getElementById("sidebar");
    var hamburger = document.getElementById("hamburger");

    sidebar.classList.toggle("open");
    hamburger.classList.toggle("open");
}

function toggleSubmenuNews() {
    const submenu = document.getElementById("submenuNews");
    // Nur umschalten, wenn das Element existiert (wichtig, wenn Login-Formular angezeigt wird)
    if (submenu) submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

function toggleSubmenuMath() {
    const submenu = document.getElementById("submenuMath");
    if (submenu) submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

function toggleSubmenuChilllounge() {
    const submenu = document.getElementById("submenuChilllounge");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", function () {

    fetch("/../sidebarcontent.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("sidebar").innerHTML = data;
    });

});