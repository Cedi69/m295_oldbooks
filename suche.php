<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lesewelt.css">

    <title>Buch</title>

    <div id="navbar">
        <div class="navbar">

            <a class="seite" href="home.html">Home</a>
            <a class="seite" href="buch.php">Buch</a>
            <a class="seite" href="ueberuns.html">Über uns</a>

            <form action="suche.php" method="post">
            <input class="input" name="text" placeholder="Search..." type="search"><br>
            </form>
        
            <img class="pinsvg" src="icons/geo-alt.svg">
            <a href="admin/login.php"><img class="personsvg" src="icons/person.svg"></a>
        </div>
    </div>
</head>
<body>
<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "book";
        $records_per_page = 12;

        // Erstellen der MYSQL Verbindung
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Die MYSQL Verbindung überprüfen
        if ($conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
        }

        // Bestimmen der aktuellen Seite
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        // Bestimmen Sie den SQL-LIMIT-Startnummer
        $start_from = ($page-1) * $records_per_page;

        // Erstellen Sie die SQL-Abfrage
        $sql = "SELECT * FROM buecher";

        // Fügen Sie die WHERE-Klausel basierend auf dem eingegebenen Suchbegriff hinzu
        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
            $sql .= " WHERE title LIKE '%$search%' OR nummer LIKE '%$search%' OR autor LIKE '%$search%' OR kategorie LIKE '%$search%' OR zustand LIKE '%$search%'";
        }

        // Überprüfen Sie, ob die Suchanfrage gesendet wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Holen Sie sich den Suchtext
            $search = $_POST["text"];

            // Erstellen Sie die SQL-Abfrage
            $sql = "SELECT * FROM buecher WHERE title LIKE '%$search%' OR nummer LIKE '%$search%' OR autor LIKE '%$search%' OR kategorie LIKE '%$search%' OR zustand LIKE '%$search%'";

            // Führen Sie die SQL-Abfrage aus
            $result = $conn->query($sql);
        }

        if ($result->num_rows > 0) {
            // Ausgabe der Daten jeder Zeilen
            while($row = $result->fetch_assoc()) {
                echo '<div class="buch2">';
                echo '<img src="icons/book.svg">';

                echo '<p class="begriffT2">Titel</p>';
                echo '<p class="begriffN3">Nummer</p>';
                echo '<p class="begriffA4">Autor</p>';
                echo '<p class="begriffK5">Kategorie</p>';
                echo '<p class="begriffZ6">Zustand</p>';

                // Überprüfen der Länge des Kurztitels mit Zeilenumbruch, wenn nötig
                $kurztitle = $row["kurztitle"];
                if (strlen($kurztitle) > 10) {
                    $kurztitle = substr($kurztitle, 0, 10) . "...";
                }
                echo '<p class="kurztitle2">' . $kurztitle . '</p>';
                echo '<p class="nummer3">' . $row["nummer"] . '</p>';
                // Überprüfen Sie, ob das Feld "autor" leer ist
                if (strlen($row["autor"])<2) {
                    echo '<p class="autor4">-</p>';
                } else {
                    $autor = $row["autor"];
                    if (strlen($autor) > 10) {
                        $autor = substr($autor, 0, 10,) . "...";
                    }
                    echo '<p class="autor4">' . $autor . '</p>';
                    }
                echo '<p class="kategorie5">' . $row["kategorie"] . '</p>';
                echo '<p class="zustand6">' . $row["zustand"] . '</p>';
                echo '</div>';
            }

        } else {
            echo "Keine Bücher gefunden";
        }
        echo '<footer class="footerbuch2">';
        // Anzahl der Seiten berechnen
        $sql = "SELECT COUNT(*) FROM buecher";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $total_records = $row[0];
        $total_pages = ceil($total_records / $records_per_page);

        // zur vorherigen Seite navigieren
        if ($page > 1) {
            echo "<a class='navigationB' href='buch.php?page=".($page-1)."'>←</a> ";
        }

        // Vorherige, aktuelle und nächste Seitenzahl anzeigen, sowie Seitenzahlen im Abstand von 20 Seiten
        for ($i=1; $i<=$total_pages; $i++) {
            if ($i == $page || $i == $page - 1 || $i == $page + 1  || $i == $page - 20 || $i == $page + 20) {
                echo "<a class='navigationZ' href='buch.php?page=".$i."'>".$i."</a> ";
            }
        }

        // zur nächsten Seite navigieren
        if ($page < $total_pages) {
            echo "<a class='navigationF' href='buch.php?page=".($page+1)."'>→</a> ";
        }
        echo '</footer>';
        $conn->close();
    ?>
    
</body>
</html>