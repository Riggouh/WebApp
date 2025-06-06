<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../user-auth/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parent_entry_id = filter_input(INPUT_POST, 'parent_entry_id', FILTER_VALIDATE_INT);
    $name = trim($_POST['username'] ?? 'Gast');
    if (empty($name)) {
        $name = 'Gast';
    }
    $reply_text = trim($_POST['reply_text'] ?? '');

    if ($parent_entry_id && !empty($reply_text)) {
        try {
            $checkStmt = $pdo->prepare("SELECT id FROM guestbook_entries WHERE id = ?");
            $checkStmt->execute([$parent_entry_id]);
            if ($checkStmt->fetch()) {
                $stmt = $pdo->prepare("INSERT INTO guestbook_replies (parent_entry_id, name, reply_text) VALUES (?, ?, ?)");
                $stmt->execute([$parent_entry_id, $name, $reply_text]);
            } else {
                error_log("Attempted to reply to non-existent parent_entry_id: " . $parent_entry_id);
            }
        } catch (PDOException $e) {
            error_log("Error saving guestbook reply: " . $e->getMessage());
            exit("Fehler beim Speichern der Antwort. Details wurden protokolliert.");
        }
    } else {
        // Handle missing parent_entry_id or reply_text
        if (!$parent_entry_id) {
            error_log("Missing parent_entry_id for reply.");
        }
        if (empty($reply_text)) {
            error_log("Empty reply_text for reply.");
        }
    }
}

$redirect_url = "index.php";
if (isset($parent_entry_id) && $parent_entry_id) { 
    $redirect_url .= "#entry-" . $parent_entry_id;
}
header("Location: " . $redirect_url);
exit();
?>