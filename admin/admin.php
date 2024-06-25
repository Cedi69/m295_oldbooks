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
            <a href="../login.php"><img class="personsvg" src="../icons/person.svg"></a>
            
        </div>
    </div>

    <div class="admin-container">
        <h1>Admin Bereich</h1>
        <a href="benutzer_verwalten.php" class="button">Benutzer verwalten</a>
        <a href="buecher_verwalten.php" class="button">Bücher verwalten</a>
        <a href="kunden_verwalten.php" class="button">Kunden verwalten</a>
        <form action="logout.php" method="post" style="display: inline;">
              <button type="submit" class="button">Logout</button>
        </form>
    </div>
    
</body>
</html>
