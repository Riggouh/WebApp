<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../user-auth/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic = trim($_POST['topic'] ?? ''); 
    $poster_name = trim($_POST['username'] ?? 'Gast'); // Get username from hidden field
    if (empty($poster_name)) {
        $poster_name = 'Gast'; // Ensure default if somehow empty after trim
    }
    $entry_text = trim($_POST['entry_text'] ?? '');

    if (!empty($topic) && !empty($entry_text)) { 
        try {
            // 'name' column stores the topic, 'poster_name' stores the user's name
            $stmt = $pdo->prepare("INSERT INTO guestbook_entries (name, poster_name, entry_text) VALUES (?, ?, ?)");
            $stmt->execute([$topic, $poster_name, $entry_text]); 
        } catch (PDOException $e) {
            error_log("Error saving guestbook entry: " . $e->getMessage()); 
            exit("Fehler beim Speichern des Beitrags. Details wurden protokolliert. Bitte versuchen Sie es später erneut oder kontaktieren Sie den Administrator.");
        }
    } else {
        // Handle empty topic or entry_text if necessary
    }
}

header("Location: index.php");
exit();
?>