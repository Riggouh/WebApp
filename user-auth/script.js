document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('register.php', {
        method: 'POST',
        body: formData
    }).then(res => res.text())
      .then(data => document.getElementById('message').innerText = data);
});

document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('login.php', {
        method: 'POST',
        body: formData
    }).then(res => res.text())
      .then(data => document.getElementById('message').innerText = data);
});
