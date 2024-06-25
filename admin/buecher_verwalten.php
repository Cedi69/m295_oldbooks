<?php
session_start();

// Verbindung zur Datenbank herstellen
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}

// Buch hinzufügen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book'])) {
    $katalog = $_POST['katalog'];
    $kurztitle = $_POST['kurztitle'];
    $kategorie = $_POST['kategorie'];
    $autor = $_POST['autor'];
    $zustand = $_POST['zustand'];

    // Serverseitige Validierung
    if (strlen($kurztitle) > 100) {
        $error_message = "Der Kurztitle darf maximal 100 Zeichen lang sein.";
    } else {
        $sql = "INSERT INTO buecher (katalog, kurztitle, kategorie, autor, zustand) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $katalog, $kurztitle, $kategorie, $autor, $zustand);

        if ($stmt->execute()) {
            $success_message = "Buch erfolgreich hinzugefügt!";
        } else {
            $error_message = "Fehler beim Hinzufügen des Buches: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Bücher abrufen
$sql = "SELECT * FROM buecher";
$result = $conn->query($sql);
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
            <h2>Buch hinzufügen</h2>
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
                <button type="submit" name="add_book">Hinzufügen</button>
            </form>
            <?php
            if (isset($error_message)) {
                echo '<p style="color:red;">' . $error_message . '</p>';
            }
            if (isset($success_message)) {
                echo '<p style="color:green;">' . $success_message . '</p>';
            }
            ?>
        </div>

        <div class="box-manage-box">
            <h2>Bücher verwalten</h2>
            <table>
                <thead>
                    <tr>
                        <th>Katalog</th>
                        <th>Nummer</th>
                        <th>Kurztitle</th>
                        <th>Kategorie</th>
                        <th>Autor</th>
                        <th>Zustand</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['katalog']); ?></td>
                            <td><?php echo htmlspecialchars($row['nummer']); ?></td>
                            <td><?php echo htmlspecialchars($row['kurztitle']); ?></td>
                            <td><?php echo htmlspecialchars($row['kategorie']); ?></td>
                            <td><?php echo htmlspecialchars($row['autor']); ?></td>
                            <td><?php echo htmlspecialchars($row['zustand']); ?></td>
                            <td>
                                <a href="bearbeitenB.php?id=<?php echo $row['id']; ?>">Bearbeiten</a>
                                <a href="loeschenB.php?id=<?php echo $row['id']; ?>">Löschen</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    
</body>
</html>

<?php $conn->close(); ?>
