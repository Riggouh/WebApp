<?php
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        echo "Login erfolgreich.";
    } else {
        echo "Login fehlgeschlagen.";
    }
} else {
    echo "Alle Felder ausfüllen.";
}
?>
