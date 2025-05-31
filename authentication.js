// filepath: c:\Users\raban\Documents\Uni\Semester2\WebEngineering-Kauan\WebApp\authentication.js
function isLoggedIn() {
    return !!localStorage.getItem('username');
}

// Zeigt das Login- und Registrierungs-Formular in der Sidebar an
function showLoginInSidebar() {
    fetch('/user-auth/index.html') // Changed to absolute path
        .then(res => {
            if (!res.ok) throw new Error(`Failed to fetch /user-auth/index.html: ${res.status}`);
            return res.text();
        })
        .then(html => {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar) {
                console.error('Sidebar element not found.');
                return;
            }
            const temp = document.createElement('div');
            temp.innerHTML = html;

            const registerFormNode = temp.querySelector('#registerForm');
            const loginFormNode = temp.querySelector('#loginForm');
            const messageNode = temp.querySelector('#message'); 
            const h2Nodes = temp.querySelectorAll('h2');
            const registerHeadingNode = h2Nodes[0]; 
            const loginHeadingNode = h2Nodes[1];    

            if (registerFormNode && loginFormNode && messageNode && registerHeadingNode && loginHeadingNode) {
                sidebar.innerHTML = `
                    ${registerHeadingNode.outerHTML}
                    ${registerFormNode.outerHTML}
                    ${loginHeadingNode.outerHTML}
                    ${loginFormNode.outerHTML}
                    ${messageNode.outerHTML}
                `;

                const existingScript = document.querySelector('script[src="/user-auth/script.js"]'); // Check for absolute path
                if (existingScript) {
                    existingScript.remove();
                }
                const script = document.createElement('script');
                script.src = '/user-auth/script.js'; // Changed to absolute path
                document.body.appendChild(script); 

            } else {
                sidebar.innerHTML = '<p>Login/Registrierungs-Formular konnte nicht geladen werden.</p>';
                console.error('Benötigte Elemente (Formulare, Überschriften, Message-Div) nicht in user-auth/index.html gefunden.');
            }
        })
        .catch(error => {
            console.error('Error in showLoginInSidebar:', error);
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.innerHTML = '<p>Fehler beim Laden des Login/Registrierungs-Formulars.</p>';
            }
        });
}

// Zeigt den Benutzernamen rechts oben an
function showUsernameTopRight(username) {
    let userDiv = document.getElementById('userTopRight');
    if (!userDiv) {
        userDiv = document.createElement('div');
        userDiv.id = 'userTopRight';
        userDiv.style.position = 'fixed';
        userDiv.style.top = '10px';
        userDiv.style.right = '20px';
        userDiv.style.background = '#eee';
        userDiv.style.padding = '8px 16px';
        userDiv.style.borderRadius = '8px';
        document.body.appendChild(userDiv);
    }
    userDiv.innerText = `Angemeldet als: ${username}`;
}
window.showUsernameTopRight = showUsernameTopRight; 

// Lädt den Sidebar-Content
function showSidebarContent() {
    fetch('/sidebarcontent.html') // Changed to absolute path
        .then(res => {
            if (!res.ok) throw new Error(`Failed to fetch /sidebarcontent.html: ${res.status}`);
            return res.text();
        })
        .then(html => {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.innerHTML = html;
            } else {
                console.error('Sidebar element not found for sidebar content.');
            }
        })
        .catch(error => {
            console.error('Error in showSidebarContent:', error);
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.innerHTML = '<p>Fehler beim Laden des Sidebar-Inhalts.</p>';
            }
        });
}
window.showSidebarContent = showSidebarContent; 

// Initialisierung beim Laden der Seite
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) {
        console.warn("#sidebar Element nicht im DOM gefunden. Wird dynamisch erstellt.");
        const newSidebar = document.createElement('div');
        newSidebar.id = 'sidebar';
        newSidebar.className = 'sidebar';
        document.body.insertBefore(newSidebar, document.body.firstChild);
    }

    if (isLoggedIn()) {
        showUsernameTopRight(localStorage.getItem('username'));
        showSidebarContent();
    } else {
        showLoginInSidebar();
    }
});

// Event-Delegation für Login-Formular WIRD ENTFERNT, da user-auth/script.js dies übernimmt
/*
document.addEventListener('submit', function (e) {
    // ... alter Code hier ...
});
*/

// Optional: Logout-Funktion
window.logout = function () {
    localStorage.removeItem('username');
    const userDiv = document.getElementById('userTopRight');
    if (userDiv) {
        userDiv.remove();
    }
    showLoginInSidebar(); 
};