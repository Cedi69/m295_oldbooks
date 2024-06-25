<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isAdmin = isset($_POST['admin']) ? 1 : 0;

    // Passwort hashen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Verbindung zur Datenbank herstellen
    $conn = new mysqli('localhost', 'root', '', 'book');

    if ($conn->connect_error) {
        die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    // Benutzername und gehashtes Passwort in die Datenbank einfügen
    $sql = "INSERT INTO benutzer (benutzername, passwort, admin) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $username, $hashed_password, $isAdmin);

    if ($stmt->execute()) {
        echo 'Registrierung erfolgreich!';
        header('Location: login.php');
    } else {
        echo 'Fehler bei der Registrierung: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Ungültige Anfrage!';
}
?>
