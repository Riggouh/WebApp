<?php
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    try {
        $stmt->execute([$username, $hash]);
        echo "Registrierung erfolgreich.";
    } catch (PDOException $e) {
        echo "Benutzername bereits vergeben.";
    }
} else {
    echo "Alle Felder ausfüllen.";
}
?>
