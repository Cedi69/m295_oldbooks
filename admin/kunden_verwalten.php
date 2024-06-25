<?php
session_start();

// Verbindung zur Datenbank herstellen
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}

// Kunde hinzufügen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_client'])) {
    $vorname = $_POST['vorname'];
    $name = $_POST['name'];
    $geschlecht = $_POST['geschlecht'];
    $email = $_POST['email'];

    // Serverseitige Validierung
    if (strlen($vorname) > 50 && strlen($name) > 50) {
        $error_message = "Der Vorname und Name darf maximal 50 Zeichen lang sein.";
    } else {
        $sql = "INSERT INTO kunden (vorname, name, geschlecht, email) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $vorname, $name, $geschlecht, $email);

        if ($stmt->execute()) {
            $success_message = "Kunden erfolgreich hinzugefügt!";
        } else {
            $error_message = "Fehler beim Hinzufügen des Kunden: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Bücher abrufen
$sql = "SELECT * FROM kunden";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lesewelt.css">
    <title>Kunden verwalten</title>
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
            <a href="logout.php"><img class="personsvg" src="../icons/person.svg"></a>
        </div>
    </div>

    <div class="box-add-box">
            <h2>Kunden hinzufügen</h2>
            <form action="kunden_verwalten.php" method="post">
                <label for="vorname">Vorname:</label>
                <input type="text" id="vorname" name="vorname" maxlength="50" required><br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" maxlength="50" required><br>
                <label for="geschlecht">Geschlecht:</label>
                <input type="text" id="geschlecht" name="geschlecht" required><br>
                <label for="email">E-Mail:</label>
                <input type="text" id="email" name="email" required><br><br>
                <button type="submit" name="add_client">Hinzufügen</button>
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
            <h2>Kunden verwalten</h2>
            <table>
                <thead>
                    <tr>
                        <th>Vorname</th>
                        <th>Name</th>
                        <th>Geschlecht</th>
                        <th>E-Mail</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['vorname']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['geschlecht']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="bearbeitenK.php?id=<?php echo $row['kid']; ?>">Bearbeiten</a>
                                <a href="loeschenK.php?id=<?php echo $row['kid']; ?>">Löschen</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    
</body>
</html>

<?php $conn->close(); ?>