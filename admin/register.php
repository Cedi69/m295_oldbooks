<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lesewelt.css">
    <title>Registrieren</title>
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
            <a href="../logout.php"><img class="personsvg" src="../icons/person.svg"></a>
        </div>
    </div>

    <div class="container">
        <h2>Registrieren</h2>
        <form action="register_handler.php" method="post">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>
            <label for="admin">Soll ein Admin sein?</label>
            <input type="checkbox" id="admin" name="admin" value="admin"><br><br>
            <button type="submit">Registrieren</button>
        </form>
    
    </footer>
</body>
</html>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
