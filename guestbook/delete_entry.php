<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../user-auth/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entry_id = filter_input(INPUT_POST, 'entry_id', FILTER_VALIDATE_INT);

    if ($entry_id) {
        try {
            // Because of ON DELETE CASCADE in the guestbook_replies table,
            // replies associated with this entry will also be deleted.
            $stmt = $pdo->prepare("DELETE FROM guestbook_entries WHERE id = ?");
            $stmt->execute([$entry_id]);
        } catch (PDOException $e) {
            error_log("Error deleting guestbook entry: " . $e->getMessage());
            exit("Fehler beim Löschen des Beitrags. Details wurden protokolliert.");
        }
    } else {
        // Invalid entry_id
        error_log("Invalid or missing entry_id for deletion.");
    }
}

header("Location: index.php");
exit();
?>