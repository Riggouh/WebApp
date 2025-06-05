<?php
<?php
require '../user-auth/db.php'; 

$stmtEntries = $pdo->query("SELECT id, name, entry_text, DATE_FORMAT(created_at, '%d.%m.%Y %H:%i') AS formatted_date FROM guestbook_entries ORDER BY created_at DESC");
$entries = $stmtEntries->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gästebuch</title>
    <link rel="stylesheet" href="/../css/styles.css">
    <link rel="stylesheet" href="style_gaestebuch.css">
</head>
<body>

    <div class="hamburger" id="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div id="sidebar" class="sidebar"></div>

    <div class="seitentitel"><h1>Gästebuch</h1></div>

    <div class="guestbook-container contentfullscreen">

        <div class="guestbook-form-section">
            <h2>Neuen Beitrag verfassen</h2>
            <form action="post_entry.php" method="POST">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="entry_text">Kommentar:</label>
                    <textarea id="entry_text" name="entry_text" rows="4" required></textarea>
                </div>
                <button type="submit">Beitrag posten</button>
            </form>
        </div>

        <hr class="guestbook-separator">

        <div class="guestbook-entries-section">
            <h2>Beiträge</h2>
            <?php if (empty($entries)): ?>
                <p>Noch keine Beiträge vorhanden.</p>
            <?php else: ?>
                <?php foreach ($entries as $entry): ?>
                    <div class="guestbook-entry">
                        <p class="entry-meta"><strong><?php echo htmlspecialchars($entry['name']); ?></strong> schrieb am <?php echo $entry['formatted_date']; ?>:</p>
                        <p class="entry-text"><?php echo nl2br(htmlspecialchars($entry['entry_text'])); ?></p>

                        <div class="replies-section">
                            <?php
                            $stmtReplies = $pdo->prepare("SELECT name, reply_text, DATE_FORMAT(created_at, '%d.%m.%Y %H:%i') AS formatted_date FROM guestbook_replies WHERE parent_entry_id = ? ORDER BY created_at ASC");
                            $stmtReplies->execute([$entry['id']]);
                            $replies = $stmtReplies->fetchAll();
                            ?>
                            <?php foreach ($replies as $reply): ?>
                                <div class="guestbook-reply">
                                    <p class="reply-meta"><strong><?php echo htmlspecialchars($reply['name']); ?></strong> antwortete am <?php echo $reply['formatted_date']; ?>:</p>
                                    <p class="reply-text"><?php echo nl2br(htmlspecialchars($reply['reply_text'])); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="reply-form-section">
                            <details>
                                <summary>Auf diesen Beitrag antworten</summary>
                                <form action="post_reply.php" method="POST">
                                    <input type="hidden" name="parent_entry_id" value="<?php echo $entry['id']; ?>">
                                    <div>
                                        <label for="reply_name_<?php echo $entry['id']; ?>">Dein Name:</label>
                                        <input type="text" id="reply_name_<?php echo $entry['id']; ?>" name="name" required>
                                    </div>
                                    <div>
                                        <label for="reply_text_<?php echo $entry['id']; ?>">Deine Antwort:</label>
                                        <textarea id="reply_text_<?php echo $entry['id']; ?>" name="reply_text" rows="3" required></textarea>
                                    </div>
                                    <button type="submit">Antwort posten</button>
                                </form>
                            </details>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="/../sidebarmenu.js" defer></script>
    <script src="/../authentication.js" defer></script>
</body>
</html>