<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verbindung zur Datenbank herstellen
    $conn = new mysqli('localhost', 'root', '', 'book'); // Passe 'buch_db' an den tatsächlichen Namen deiner Datenbank an

    if ($conn->connect_error) {
        die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    // Benutzername in der Datenbank suchen
    $sql = "SELECT * FROM benutzer WHERE benutzername = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Passwort überprüfen
        if (password_verify($password, $user['passwort'])) {
            // Login erfolgreich, Benutzer in Session speichern
            $_SESSION['username'] = $username;
            header('Location: admin.php'); // Erfolgreich angemeldet, weiterleiten zur Admin-Seite
            exit();
        } else {
            // Falsches Passwort
            $error_message = 'Ungültiger Benutzername oder Passwort!';
        }
    } else {
        // Benutzername nicht gefunden
        $error_message = 'Ungültiger Benutzername oder Passwort!';
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
    <title>Login</title>
</head>
<body>
    <div id="navbar">
        <div class="navbar">
            <a class="seite" href="../home.html">Home</a>
            <a class="seite" href="../buch.php">Buch</a>
            <a class="seite" href="../ueberuns.html">Über uns</a>
            <form action="../suche.php" id="input" method="post">
                <input class="input" name="text" placeholder="Search..." type="search"><br>
            </form>
            <img class="pinsvg" src="../icons/geo-alt.svg">
            <a href="login.php"><img class="personsvg" src="../icons/person.svg"></a>
        </div>
    </div>

    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="login.php" method="post">
            <div class="input-container">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</html>
