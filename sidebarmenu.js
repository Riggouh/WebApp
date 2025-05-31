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

function toggleSubmenuProgramming() {
    const submenu = document.getElementById("submenuProgramming");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
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
    // Content fetching removed from here.
    // authentication.js will handle loading the correct sidebar content.
});