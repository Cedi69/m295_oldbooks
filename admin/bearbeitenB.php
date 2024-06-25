<?php
session_start();

// Verbindung zur Datenbank herstellen
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_book'])) {
    $kurztitle = $_POST['kurztitle'];

    $sql = "SELECT * FROM buecher WHERE kurztitle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $kurztitle);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
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
            <h2>Buch bearbeiten</h2>

    <form method="post" action="bearbeitenB.php">
        <input type="text" name="kurztitle" placeholder="Kurztitle des zu bearbeitenden Buches">
        <input type="submit" name="search_book" value="Buch suchen">
    </form>

    <?php if (isset($book)): ?>
        <form method="post" action="bearbeitenB.php">
        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">

        <label for="katalog">Katalog:</label>
        <input type="text" id="katalog" name="katalog" value="<?php echo $book['katalog']; ?>">
        
            <form action="buecher_verwalten.php" method="post">
            <label for="katalog">Katalog:</label>
                <input type="text" id="katalog" name="katalog" required><br>
                <label for="kurztitle">Kurztitle:</label>
                <input type="text" id="kurztitle" name="kurztitle" maxlength="100" required><br>
                <label for="kategorie">Kategorie:</label>
                <input type="text" id="kategorie" name="kategorie" required><br>
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required><br>
                <label for="zustand">Zustand:</label>
                <input type="text" id="zustand" name="zustand"><br><br>
                <button type="submit" name="edit_book">Bearbeiten</button>
                <input type="submit" name="edit_book" value="Buch bearbeiten">
            </form>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>




