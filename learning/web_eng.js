/**
 * Dieses Skript steuert eine Tab-Navigation für HTML-, CSS- und JS-Lerninhalte.
 * - Beim Klick auf einen Tab wird der entsprechende Inhalt per Fetch geladen und angezeigt.
 * - Der aktive Tab wird visuell hervorgehoben.
 * - Der JS-Tab kann zusätzliche Interaktionen (z.B. Event Listener) auslösen.
 * - Beim Seitenladen wird automatisch der HTML-Tab geladen.
 */

function switchTab(tabId) {
  const sections = ['html', 'css', 'js'];
  const buttons = document.querySelectorAll(".tab-navigation button");

  buttons.forEach(button => {
    button.classList.toggle("active", button.textContent.toLowerCase() === tabId);
  });

  sections.forEach(id => {
    const section = document.getElementById(id);
    if (id === tabId) {
      fetch(`/../learning/${id}.html`)
        .then(response => response.text())
        .then(data => {
          section.innerHTML = data;
          section.style.display = "flex";
          if (id === "js") setupJS();
        });
    } else {
      section.style.display = "none";
    }
  });
}

function setupJS() {
  const jsButton = document.querySelector("#js .link-box_news");
  if (jsButton) {
    jsButton.addEventListener("click", function () {
      alert("Hallo Welt!");
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  switchTab('html');
});
