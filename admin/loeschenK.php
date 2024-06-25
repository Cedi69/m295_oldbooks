<?php
session_start();

// Verbindung zur Datenbank herstellen
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lesewelt.css">
    <title>Bücher verwalten</title>
</head>
<body>
    <div id="navbar">
        <div class="navbar">
            <a class="seite" href="../home.html">Home</a>
            <a class="seite" href="../buch.php">Bücher</a>
            <a class="seite" href="../ueberuns.html">Über uns</a>
            <form action="../suche.php" id="input" method="post">
                <input class="input" name="text" placeholder="Search..." type="search"><br>
            </form>
            <img class="pinsvg" src="../icons/geo-alt.svg">
            <a href="login.php"><img class="personsvg" src="../icons/person.svg"></a>
        </div>
    </div>

   
        <div class="box-add-box">
            <h2>Kunden löschen</h2>
            <form action="kunden_verwalten.php" method="post">
                <label for="vorname">Vorname:</label><br>
                <input type="text" id="vorname" name="vorname" required><br><br>
                <input type="submit" name="delete_client" value="Buch löschen">
        </div>
        <?php
// Kunden löschen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_client'])) {
    $vorname = $_POST['vorname'];

    $sql = "DELETE FROM kunden WHERE vorname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $vorname);

    if ($stmt->execute()) {
        $success_message = "Kunden erfolgreich gelöscht!";
    } else {
        $error_message = "Fehler beim Löschen des Kunden: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close(); ?>
    </div>
    
</body>
</html>