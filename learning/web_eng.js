function switchTab(tabId) {
  const sections = ['html', 'css', 'js'];
  const buttons = document.querySelectorAll(".tab-navigation button");

  // Toggle Button Active Style
  buttons.forEach(button => {
    button.classList.toggle("active", button.textContent.toLowerCase() === tabId);
  });

  // Inhalte auslagern und laden
  sections.forEach(id => {
    const section = document.getElementById(id);
    if (id === tabId) {
      fetch(`/../learning/${id}.html`)
        .then(response => response.text())
        .then(data => {
          section.innerHTML = data;
          section.style.display = "flex";
          if (id === "js") setupJS(); // zusätzliche Funktion für interaktive Buttons
        });
    } else {
      section.style.display = "none";
    }
  });
}

// Nur bei JavaScript-Tab: Button-Event setzen
function setupJS() {
  const jsButton = document.querySelector("#js .link-box_news");
  if (jsButton) {
    jsButton.addEventListener("click", function () {
      alert("Hallo Welt!");
    });
  }
}

// Initialer Tab
document.addEventListener("DOMContentLoaded", () => {
  switchTab('html');
});
