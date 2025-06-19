<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopfrechnen - Division</title>
    <link rel="stylesheet" href="/../css/styles.css">
</head>

<body>

<div class="hamburger" id="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
</div>

<div id="sidebar" class="sidebar"></div>

<div class="seitentitel"><h1>Kopfrechnen - Division</h1></div>

<div class="contentfullscreen_math">
    <?php
    // Erzeuge zwei Zahlen so, dass die Division ein ganzzahliges Ergebnis hat
    $divisor = rand(1, 20);
    $ergebnis = rand(1, 10);
    $dividend = $divisor * $ergebnis; // Sicherstellen, dass dividend durch divisor teilbar ist

    $anzeige = "$dividend ÷ $divisor = ";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userErgebnis = $_POST['ergebnis'];
        $korrekt = $userErgebnis == $_POST['korrektesErgebnis'];
        echo $korrekt ? "Richtig!" : "Falsch!";
        echo "<br>";
        echo "Die richtige Lösung war: " . $_POST['dividend'] . " ÷ " . $_POST['divisor'] . " = " . $_POST['korrektesErgebnis'];
        echo "<br><br>";

        // Neue Aufgabe generieren
        $divisor = rand(1, 20);
        $ergebnis = rand(1, 10);
        $dividend = $divisor * $ergebnis;
        $anzeige = "$dividend ÷ $divisor = ";
    }
    ?>

    <form method="POST">
        <?php echo $anzeige; ?>
        <input type="hidden" name="korrektesErgebnis" value="<?php echo $ergebnis; ?>">
        <input type="hidden" name="dividend" value="<?php echo $dividend; ?>">
        <input type="hidden" name="divisor" value="<?php echo $divisor; ?>">
        <input type="number" name="ergebnis" required>
        <input type="submit" value="Prüfen">
    </form>
</div>

<script src="/../sidebarmenu.js" defer></script>
<script src="/../authentication.js" defer></script>
</body>

</html>
