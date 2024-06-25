<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Verbindung zur Datenbank herstellen
    $conn = new mysqli('localhost', 'root', '', 'book');

    if ($conn->connect_error) {
        die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    // Altes Passwort überprüfen
    $sql = "SELECT passwort FROM benutzer WHERE benutzername = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Passwort überprüfen
        if (password_verify($old_password, $user['passwort'])) {
            // Neues Passwort hashen und speichern
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE benutzer SET passwort = ? WHERE benutzername = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $new_hashed_password, $username);
            if ($stmt->execute()) {
                header('Location: login.php');
                exit();
            } else {
                $error_message = 'Fehler beim Ändern des Passworts: ' . $stmt->error;
            }
        } else {
            $error_message = 'Altes Passwort ist falsch!';
        }
    } else {
        $error_message = 'Benutzername nicht gefunden!';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lesewelt.css">
    <title>Passwort Zurücksetzen</title>
</head>
<body>
    <div id="navbar">
    <   div class="navbar">
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

    <div class="container">
        <h2>Passwort zurücksetzen</h2>
        <form action="reset_password.php" method="post">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required>
            <label for="old_password">Altes Passwort:</label>
            <input type="password" id="old_password" name="old_password" required>
            <label for="new_password">Neues Passwort:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Bestätigen</button>
        </form>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</html>
