<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopfrechnen - Multiplikation</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<div class="hamburger" id="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
</div>

<div id="sidebar" class="sidebar"></div>

<div class="seitentitel"><h1>Kopfrechnen - Multiplikation</h1></div>

<div class="contentfullscreen_math">
    <?php
    $zahl1 = rand(1, 20); // kleinerer Bereich für bessere Rechenbarkeit
    $zahl2 = rand(1, 20);
    $ergebnis = $zahl1 * $zahl2;
    $anzeige = "$zahl1 × $zahl2 = ";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userErgebnis = $_POST['ergebnis'];
        $korrekt = $userErgebnis == $_POST['korrektesErgebnis'];
        echo $korrekt ? "Richtig!" : "Falsch!";
        echo "<br>";
        echo "Die richtige Lösung war: " . $_POST['zahl1'] . " × " . $_POST['zahl2'] . " = " . $_POST['korrektesErgebnis'];
        echo "<br><br>";

        // Neue Aufgabe generieren
        $zahl1 = rand(1, 20);
        $zahl2 = rand(1, 20);
        $ergebnis = $zahl1 * $zahl2;
        $anzeige = "$zahl1 × $zahl2 = ";
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

<script src="../sidebarmenu.js" defer></script>
<script src="../authentication.js" defer></script>
</body>

</html>
