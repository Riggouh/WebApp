function toggleMenu() {
    var sidebar = document.getElementById("sidebar");
    var hamburger = document.getElementById("hamburger");

    sidebar.classList.toggle("open");
    hamburger.classList.toggle("open");
}

function toggleSubmenuNews() {
    const submenu = document.getElementById("submenuNews");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

function toggleSubmenuMath() {
    const submenu = document.getElementById("submenuMath");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

function toggleSubmenuChilllounge() {
    const submenu = document.getElementById("submenuChilllounge");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", function () {
    fetch("/WebApp/sidebarcontent.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("sidebar").innerHTML = data;
    });
});