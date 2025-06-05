<?php
<?php
require '../user-auth/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parent_entry_id = filter_input(INPUT_POST, 'parent_entry_id', FILTER_VALIDATE_INT);
    $name = trim($_POST['name'] ?? '');
    $reply_text = trim($_POST['reply_text'] ?? '');

    if ($parent_entry_id && !empty($name) && !empty($reply_text)) {
        try {
            // Check if parent entry exists
            $checkStmt = $pdo->prepare("SELECT id FROM guestbook_entries WHERE id = ?");
            $checkStmt->execute([$parent_entry_id]);
            if ($checkStmt->fetch()) {
                $stmt = $pdo->prepare("INSERT INTO guestbook_replies (parent_entry_id, name, reply_text) VALUES (?, ?, ?)");
                $stmt->execute([$parent_entry_id, $name, $reply_text]);
            } 
        } catch (PDOException $e) {
            die("Fehler beim Speichern der Antwort: " . $e->getMessage());
        }
    }
}

header("Location: index.php#entry-" . $parent_entry_id); // Attempt to redirect to the specific entry
exit();
?>