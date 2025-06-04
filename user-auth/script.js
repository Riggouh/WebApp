document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/user-auth/register.php', {
        method: 'POST',
        body: formData
    }).then(res => {
        if (!res.ok) {
            return res.text().then(text => { throw new Error(text || `Registrierungsfehler: ${res.status}`); });
        }
        return res.text();
    })
        .then(data => {
            const messageDiv = document.getElementById('message');
            if (messageDiv) messageDiv.innerText = data;
        })
        .catch(error => {
            console.error('Registration fetch error:', error);
            const messageDiv = document.getElementById('message');
            if (messageDiv) messageDiv.innerText = `Registrierungs-Fehler: ${error.message}.`;
        });
});

document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const username = formData.get('username');

    fetch('/user-auth/login.php', {
        method: 'POST',
        body: formData
    })
        .then(res => {
            if (!res.ok) {
                return res.text().then(text => {
                    // specific error 405
                    if (res.status === 405) {
                        throw new Error(`Methode nicht erlaubt (405). Bitte Serverkonfiguration für PHP POST-Requests prüfen.`);
                    }
                    throw new Error(text || `Loginfehler: ${res.status}`);
                });
            }
            return res.text();
        })
        .then(data => {
            const messageDiv = document.getElementById('message');
            if (data.includes('Erfolg') || data.toLowerCase().includes('erfolgreich')) {
                localStorage.setItem('username', username);
                if (window.showUsernameTopRight) {
                    window.showUsernameTopRight(username);
                }
                if (window.showSidebarContent) {
                    window.showSidebarContent();
                }

            } else {
                if (messageDiv) {
                    messageDiv.innerText = data || "Login fehlgeschlagen.";
                }
            }
        })
        .catch(error => {
            console.error('Login fetch error in user-auth/script.js:', error);
            const messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.innerText = `${error.message}`;
            }
        });
});
