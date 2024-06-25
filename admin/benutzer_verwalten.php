<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lesewelt.css">
    <title>Benutzer verwalten</title>
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

    <a href="register.php" class="button">Noch keinen Account? Registrieren</a>
    <a href="reset_password.php" class="button">Passwort zurücksetzen</a>

    <div>
        <?php
        $db = mysqli_connect('localhost', 'root', '', 'book');
        if (!$db) {
            die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
        }

        $sql = "SELECT benutzername, name, vorname, email FROM benutzer";
        $result = mysqli_query($db, $sql);

        echo "<div class='admin-container'>";
        echo "<h2>Benutzer verwalten</h2>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "Benutzername: " . $row['benutzername'] . "<br>";
            echo "Name: " . $row['name'] . "<br>";
            echo "Vorname: " . $row['vorname'] . "<br>";
            echo "E-Mail: " . $row['email'] . "<br>";
            echo "<hr>";
        }
        echo "</div>";
        ?>
    </div>

    <footer>
        <div class="footerhome">
            <img class="facebook" src="../icons/Facebook_icon.svg">
            <img class="instagram" src="../icons/Instagram_icon.png.webp">
            <img class="snapchat" src="../icons/snapchat-logo.png">
            <img class="whatsapp" src="../icons/WhatsApp.svg.png">
        </div>
    </footer>
</body>
</html>
