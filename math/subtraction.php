<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopfrechnen - Subtraktion</title>
    <link rel="stylesheet" href="/WebApp/css/styles.css">
</head>

<body>

<div class="hamburger" id="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
</div>

<div id="sidebar" class="sidebar"></div>

<div class="seitentitel"><h1>Kopfrechnen - Subtraktion</h1></div>

<div class="contentfullscreen">
    <?php
    // Stelle sicher, dass die größere Zahl zuerst kommt, damit keine negativen Ergebnisse entstehen
    $zahl1 = rand(1, 100);
    $zahl2 = rand(1, 100);
    if ($zahl1 < $zahl2) {
        [$zahl1, $zahl2] = [$zahl2, $zahl1]; // Tausche die Werte
    }
    $ergebnis = $zahl1 - $zahl2;
    $anzeige = "$zahl1 - $zahl2 = ";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userErgebnis = $_POST['ergebnis'];
        $korrekt = $userErgebnis == $_POST['korrektesErgebnis'];
        echo $korrekt ? "Richtig!" : "Falsch!";
        echo "<br>";
        echo "Die richtige Lösung war: " . $_POST['zahl1'] . " - " . $_POST['zahl2'] . " = " . $_POST['korrektesErgebnis'];
        echo "<br><br>";

        // Neue Aufgabe generieren
        $zahl1 = rand(1, 100);
        $zahl2 = rand(1, 100);
        if ($zahl1 < $zahl2) {
            [$zahl1, $zahl2] = [$zahl2, $zahl1];
        }
        $ergebnis = $zahl1 - $zahl2;
        $anzeige = "$zahl1 - $zahl2 = ";
    }
    ?>

    <form method="POST">
        <?php echo $anzeige; ?>
        <input type="hidden" name="korrektesErgebnis" value="<?php echo $ergebnis; ?>">
        <input type="hidden" name="zahl1" value="<?php echo $zahl1; ?>">
        <input type="hidden" name="zahl2" value="<?php echo $zahl2; ?>">
        <input type="number" name="ergebnis" required>
        <input type="submit" value="Prüfen">
    </form>
</div>

<script src="/WebApp/sidebarmenu.js" defer></script>

</body>

</html>
