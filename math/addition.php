<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopfrechnen - Addition</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<div class="hamburger" id="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
</div>

<div id="sidebar" class="sidebar"></div>

<div class="seitentitel"><h1>Kopfrechnen - Addition</h1></div>

<div class = "contentfullscreen_math">
    <?php
    $zahl1 = rand(1, 100);
    $zahl2 = rand(1, 100);
    $summe = $zahl1 + $zahl2;
    $anzeige = "$zahl1 + $zahl2 = "; // Speichere die aktuelle Aufgabe für die Anzeige

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userSum = $_POST['summe'];
        $korrekt = $userSum == $_POST['korrekteSumme'];
        echo $korrekt ? "Richtig!" : "Falsch!";
        echo "<br>";
        echo "Die richtige Lösung war: " . $_POST['korrekteZahl1'] . " + " . $_POST['korrekteZahl2'] . " = " . $_POST['korrekteSumme'];
        echo "<br><br>";

        // Neue Aufgabe generieren
        $zahl1 = rand(1, 100);
        $zahl2 = rand(1, 100);
        $summe = $zahl1 + $zahl2;
        $anzeige = "$zahl1 + $zahl2 = "; // Aktualisiere die Anzeige für die neue Aufgabe
    }
    ?>

    <form method="POST">
        <?php echo $anzeige; ?>
        <input type="hidden" name="korrekteSumme" value="<?php echo $summe; ?>">
        <input type="hidden" name="korrekteZahl1" value="<?php echo $zahl1; ?>">
        <input type="hidden" name="korrekteZahl2" value="<?php echo $zahl2; ?>">
        <input type="number" name="summe" required>
        <input type="submit" value="Prüfen">
    </form>

</div>

<script src="../sidebarmenu.js" defer></script> 
<script src="../authentication.js" defer></script>

</body>

</html>