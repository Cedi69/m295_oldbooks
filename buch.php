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

            <form action="suche.php" id="input" method="post">
            <input class="input" name="text" placeholder="Search..." type="search"><br>
            </form>
        
            <img class="pinsvg" src="icons/geo-alt.svg">
            <a href="admin/login.php"><img class="personsvg" src="icons/person.svg"></a>
        </div>
    </div>
</head>
<body>

    <!-- Filtern nach Container -->
    <div class="filtern">
    <label for="Filtern">Filtern nach:</label>
        <img src="icons/funnel.svg" width="25px" class="bild1">
    </div>
    <form action="filter.php" method="post">
    <div class="filter-container">
        <ul>
            <li>
                <p>Katalog</p>
                <input type="radio" id="10" name="katalog" value="10">
                <label for="10">10</label><br>
                <input type="radio" id="11" name="katalog" value="11">
                <label for="11">11</label><br>
                <input type="radio" id="12" name="katalog" value="12">
                <label for="12">12</label><br>
                <input type="radio" id="13" name="katalog" value="13">
                <label for="13">13</label><br>
                <input type="radio" id="14" name="katalog" value="14">
                <label for="14">14</label><br>
                <input type="radio" id="15" name="katalog" value="15">
                <label for="15">15</label><br>
                <input type="radio" id="16" name="katalog" value="16">
                <label for="16">16</label><br>
                <input type="radio" id="17" name="katalog" value="17">
                <label for="17">17</label><br>
                <input type="radio" id="18" name="katalog" value="18">
                <label for="18">18</label><br>
            </li>
            <hr>
            <li>
                <p>Kategorie</p>
                <input type="radio" id="alte-drucke" name="kategorie" value="1">
                <label for="alte-drucke">Alte Drucke</label><br>
                <input type="radio" id="geographie" name="kategorie" value="2">
                <label for="geographie">Geographie</label><br>
                <input type="radio" id="geschichtswissenschaft" name="kategorie" value="3">
                <label for="geschichtswissenschaft">Geschichtswissenschaft</label><br>
                <input type="radio" id="naturwissenschaft" name="kategorie" value="4">
                <label for="naturwissenschaft">Naturwissenschaft</label><br>
                <input type="radio" id="kinderbücher" name="kategorie" value="5">
                <label for="kinderbücher">Kinderbücher</label><br>
                <input type="radio" id="moderneliteratur" name="kategorie" value="6">
                <label for="moderneliteratur">Moderne Literatur</label><br>
                <input type="radio" id="kunstwissenschaft" name="kategorie" value="7">
                <label for="kunstwissenschaft">Kunstwissenschaft</label><br>
                <input type="radio" id="architektur" name="kategorie" value="8">
                <label for="architektur">Architektur</label><br>
                <input type="radio" id="technik" name="kategorie" value="9">
                <label for="technik">Technik</label><br>
                <input type="radio" id="medizin" name="kategorie" value="10">
                <label for="medizin">Medizin</label><br>
                <input type="radio" id="ozeanien" name="kategorie" value="11">
                <label for="ozeanien">Ozeanien</label><br>
                <input type="radio" id="afrika" name="kategorie" value="12">
                <label for="afrika">Afrika</label>
            </li>
            <hr>
            <li>
                <p>Zustand</p>
                <input type="radio" id="neu" name="zustand" value="S">
                <label for="neu">Neu</label><br>
                <input type="radio" id="gebraucht" name="zustand" value="G">
                <label for="gebraucht">Gebraucht</label><br>
                <input type="radio" id="gebrauchsspruren" name="zustand" value="M">
                <label for="gebrauchsspruren">Gebrauchsspruren</label><br>
            </li>
        </ul>
    </div>
    <!-- Sortieren nach Container -->
    <div class="sort-container">
        <label for="sortieren">Sortieren nach:</label>
        <img src="icons/sort-down.svg" width="25px" class="bild2">
        </div>
        <form action="buch.php" method="post">
        <div class="sortieren-container">
            <ul>
                <li>
                    <p>Katalog</p>
                    <input type="radio" id="Abwärts (10-18)" name="sortKatalog" value="Abwärts (10-18)">
                    <label for="Abwärts (10-18)">Abwärts (10-18)</label><br>
                    <input type="radio" id="Aufwärts (18-10)" name="sortKatalog" value="Aufwärts (18-10)">
                    <label for="Aufwärts (18-10)">Aufwärts (18-10)</label><br>
                    
                </li>
                <hr>
                <li>
                    <p>Titel</p>
                    <input type="radio" id="Abwärts (A-Z)" name="sortTitle" value="Abwärts (A-Z)">
                    <label for="Abwärts (A-Z)">Abwärts (A-Z)</label><br>
                    <input type="radio" id="Aufwärts (Z-A)" name="sortTitle" value="Aufwärts (Z-A)">
                    <label for="Aufwärts (Z-A)">Aufwärts (Z-A)</label><br>
                </li>
                <hr>
                <li>
                    <p>Autor</p>
                    <input type="radio" id="Abwärts (A-Z)" name="sortAutor" value="Abwärts (A-Z)">
                    <label for="Abwärts (A-Z)">Abwärts (A-Z)</label><br>
                    <input type="radio" id="Aufwärts (Z-A)" name="autor-sort" value="Aufwärts (Z-A)">
                    <label for="Aufwärts (Z-A)">Aufwärts (Z-A)</label><br>

                </li>
                <hr>
                <li>
                    <p>Kategorie</p>
                    <input type="radio" id="Abwärts (A-Z)" name="sortZustand" value="Abwärts (A-Z)">
                    <label for="Abwärts (A-Z)">Abwärts (A-Z)</label><br>
                    <input type="radio" id="Aufwärts (Z-A)" name="zustand-sort" value="Aufwärts (Z-A)">
                    <label for="Aufwärts (Z-A)">Aufwärts (Z-A)</label><br>
                </li>
            </ul>
        </div>
        <input type="submit" id="submit" value="Bücher sortieren/filtern">
    </form>

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

        // Ausführen der SQL-Abfrage
        $sql = "SELECT * FROM buecher LIMIT $start_from, $records_per_page";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // Ausgabe der Daten jeder Zeilen
            while($row = $result->fetch_assoc()) {
                echo '<div class="buch">';
                echo '<img src="icons/book.svg">';

                echo '<p class="begriffT">Titel</p>';
                echo '<p class="begriffN">Nummer</p>';
                echo '<p class="begriffA">Autor</p>';
                echo '<p class="begriffK">Kategorie</p>';
                echo '<p class="begriffZ">Zustand</p>';

                // Überprüfen der Länge des Kurztitels mit Zeilenumbruch, wenn nötig
                $kurztitle = $row["kurztitle"];
                if (strlen($kurztitle) > 10) {
                    $kurztitle = substr($kurztitle, 0, 10) . "...";
                }
                echo '<p class="kurztitle">' . $kurztitle . '</p>';
                echo '<p class="nummer">' . $row["nummer"] . '</p>';
                // Überprüfen Sie, ob das Feld "autor" leer ist
                if (strlen($row["autor"])<2) {
                    echo '<p class="autor">-</p>';
                } else {
                    $autor = $row["autor"];
                    if (strlen($autor) > 10) {
                        $autor = substr($autor, 0, 10,) . "...";
                    }
                    echo '<p class="autor">' . $autor . '</p>';
                    }
                echo '<p class="kategorie">' . $row["kategorie"] . '</p>';
                echo '<p class="zustand">' . $row["zustand"] . '</p>';
                echo '</div>';
            }

        } else {
            echo "Keine Bücher gefunden";
        }
        echo '<footer class="footerbuch">';
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