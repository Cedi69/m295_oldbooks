<?php
session_start();

// Verbindung zur Datenbank herstellen
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_kunden'])) {
    $vorname = $_POST['vorname'];

    $sql = "SELECT * FROM kunden WHERE vorname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $vorname);
    $stmt->execute();
    $result = $stmt->get_result();
    $client = $result->fetch_assoc();
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
            <h2>Kunden bearbeiten</h2>

    <form method="post" action="bearbeitenK.php">
        <input type="text" name="vorname" placeholder="Vorname des zu bearbeitenden Kunden">
        <input type="submit" name="search_book" value="Kunden suchen">
    </form>

    <?php if (isset($client)): ?>
        <form method="post" action="bearbeitenK.php">
        <input type="hidden" name="id" value="<?php echo $client['kid']; ?>">

        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" value="<?php echo $client['vorname']; ?>">
        
            

            <form action="kunden_verwaltung.php" method="post">
                <label for="vorname">Vorname:</label>
                <input type="text" id="vorname" name="vorname" maxlength="50" required><br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" maxlength="50" required><br>
                <label for="geschlecht">Geschlecht:</label>
                <input type="text" id="geschlecht" name="geschlecht" required><br>
                <label for="email">E-Mail:</label>
                <input type="text" id="email" name="email" required><br><br>
                <button type="submit" name="edit_client">Bearbeiten</button>
                <input type="submit" name="edit_client" value="Kunden bearbeiten">
            </form>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>




