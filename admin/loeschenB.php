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
            <h2>Buch löschen</h2>
            <form action="buecher_verwalten.php" method="post">
                <label for="kurztitle">Kurztitle:</label><br>
                <input type="text" id="kurztitle" name="kurztitle" required><br><br>
                <input type="submit" name="delete_book" value="Buch löschen">
        </div>
        <?php
// Buch löschen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_book'])) {
    $kurztitle = $_POST['kurztitle'];

    $sql = "DELETE FROM buecher WHERE kurztitle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $kurztitle);

    if ($stmt->execute()) {
        $success_message = "Buch erfolgreich gelöscht!";
    } else {
        $error_message = "Fehler beim Löschen des Buches: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close(); ?>
    </div>
    
</body>
</html>





