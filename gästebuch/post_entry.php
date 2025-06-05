<?php
<?php
require '../user-auth/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $entry_text = trim($_POST['entry_text'] ?? '');

    if (!empty($name) && !empty($entry_text)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO guestbook_entries (name, entry_text) VALUES (?, ?)");
            $stmt->execute([$name, $entry_text]);
        } catch (PDOException $e) {
            die("Fehler beim Speichern des Beitrags: " . $e->getMessage());
        }
    }
}

header("Location: index.php");
exit();
?>