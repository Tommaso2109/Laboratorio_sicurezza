<?php 
session_start(); // Start the session at the beginning of your file 
?>
<!DOCTYPE html>
<html lang="IT">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FormulaForFun</title>
        <link rel="stylesheet" href="statisticheApiStyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.min.css" integrity="sha512-fJcFDOQo2+/Ke365m0NMCZt5uGYEWSxth3wg2i0dXu7A1jQfz9T4hdzz6nkzwmJdOdkcS8jmy2lWGaRXl+nFMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    
<body>
    <div class="header">
        <div class="logo">
            <a href="../index.php" class="box-link"><img src="../media/logo.png" alt=""></a>
        </div>

        <ul class="menu">
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="../pagina_personale.php" id="userImage"><img src="<?php echo $_SESSION['profile_image']; ?>" alt="image"></a></li>
                <label><a href="../logout.php" id="logoutButton" class="menu-text">LOGOUT</a></label>
            <?php else: ?>
                <label><a href="../login.html" id="loginButton" class="menu-text">LOGIN</a></label>
                <label><a href="../register.html" id="registerButton" class="menu-text">REGISTER</a></label>
            <?php endif; ?>
            <li><a href="../stats.php" class="menu-text">Stats</a></li>
            <li><a href="../piloti.php" class="menu-text">Piloti</a>
                <ul>
                    <li><a href="../piloti/verstappen.php">Max Verstappen</a></li> 
                    <li><a href="../piloti/perez.php">Sergio Perez</a></li> 
                    <li><a href="../piloti/Hamilton.php">Lewis Hamilton</a></li> 
                    <li><a href="../piloti/Russel.php">George Russell</a></li> 
                    <li><a href="../piloti/Leclerc.php">Charles Leclerc</a></li>
                    <li><a href="../piloti/sainz.php">Carlos Sainz</a></li> 
                    <li><a href="../piloti/Norris.php">Lando Norris</a></li>
                    <li><a href="../piloti/piastri.php">Oscar Piastri</a></li>
                    <li><a href="../piloti/Alonso.php">Fernando Alonso</a></li>
                    <li><a href="../piloti/Stroll.php">Lance Stroll</a></li>                     
                    <li><a href="../piloti/Gasly.php">Pierre Gasly</a></li>
                    <li><a href="../piloti/Ocon.php">Esteban Ocon</a></li>
                    <li><a href="../piloti/Albon.php">Alexander Albon</a></li>
                    <li><a href="../piloti/Sargeant.php">Logan Sargeant</a></li>
                    <li><a href="../piloti/Tsunoda.php">Yuki Tsunoda</a></li>
                    <li><a href="../piloti/Ricciardo.php">Daniel Ricciardo</a></li>
                    <li><a href="../piloti/bottas.php">Valterri Bottas</a></li>
                    <li><a href="../piloti/Zhou.php">Ghuanyu Zhou</a></li>
                    <li><a href="../piloti/Hulkenberg.php">Nico Hulkenberg</a></li>
                    <li><a href="../piloti/magnussen.php">Kevin Magnussen</a></li>
                </ul>
            </li>
            <li><a href="../scuderie.php" class="menu-text">Scuderie</a>
                <ul>
                    <span><a href="../scuderie/RedBull.php" >Red Bull</a></span>
                    <span><a href="../scuderie/Mercedes.php" >Mercedes</a></span>
                    <span><a href="../scuderie/Ferrari.php" >Ferrari</a></span>
                    <span><a href="../scuderie/McLaren.php" >McLaren</a></span>
                    <span><a href="../scuderie/AstonMartin.php" >Aston Martin</a></span>
                    <span><a href="../scuderie/Alpine.php" >Alpine</a></span>
                    <span><a href="../scuderie/Williams.php" >Williams</a></span>                       
                    <span><a href="../scuderie/AlphaTauri.php" >Alpha Tauri</a></span>
                    <span><a href="../scuderie/KickSaubern.php" >Kick Saubern</a></span>
                    <span><a href="../scuderie/Haas.php" >Haas</a></span>
                </ul>
            </li>
            <li><a href="../fanta-formula.php" class="menu-text">Fanta-Formula</a></li> 
            <label><a href="../login.php"class="menu-text">Login</a></label>
            <label><a href="../register.php"class="menu-text">Register</a></label>
        </ul>

        <div class="r-l">
        <?php if(isset($_SESSION['username'])): ?>
                    <a href="../pagina_personale.php" id="userImage"><img src="<?php echo $_SESSION['profile_image']; ?>" alt="image"></a>
                    <a href="../logout.php" id="logoutButton" class="button">LOGOUT</a>
                <?php else: ?>
                    <a href="../login.html" id="loginButton" class="button">LOGIN</a>
                    <p>
                    <a href="../register.html" id="registerButton" class="button">REGISTER</a>
                <?php endif; ?>
        </div>

        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="mt-4">
        <div class="grid-container">
            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="image-box">
                    <img src="../media/versatppen.avif" alt="Driver Image">
                </div>
                <?php $pilota = "Max VERSTAPPEN" ?>
                <div class="data-box">
                    <div class="data-item">
                        Laps: 
                        <?php
                            // Database connection
                            $db = new mysqli('localhost', 'root', '', 'statistiche');

                            // Check connection
                            if ($db->connect_error) {
                                die("Connection failed: " . $db->connect_error);
                            }

                            // Get specific data from the database for each driver_number
                            $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                            $result = $db->query("
                                SELECT
                                    driverdata.full_name,
                                    ROUND(AVG(random_lapsdata.duration_sector_1), 2) AS avg_duration_sector_1,
                                    ROUND(AVG(random_lapsdata.duration_sector_2), 2) AS avg_duration_sector_2,
                                    ROUND(AVG(random_lapsdata.duration_sector_3), 2) AS avg_duration_sector_3,
                                    ROUND(AVG(random_lapsdata.lap_duration), 2) AS avg_lap_duration,
                                    MAX(random_lapsdata.lap_number) AS max_lap_number
                                FROM
                                    (SELECT * FROM lapsdata WHERE duration_sector_1 IS NOT NULL AND duration_sector_2 IS NOT NULL AND duration_sector_3 IS NOT NULL AND lap_duration IS NOT NULL AND lap_number IS NOT NULL ORDER BY RAND()) AS random_lapsdata
                                JOIN
                                    driverdata ON random_lapsdata.driver_number = driverdata.driver_number
                                WHERE
                                    driverdata.full_name = '$pilota'
                                GROUP BY
                                    driverdata.full_name
                                ORDER BY 
                                    avg_lap_duration
                            ");

                            // Check if the query was successful
                            if ($result === false) {
                                die("Query failed: " . $db->error);
                            }

                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th>Pilota</th>";
                            echo "<th>Duration Sector 1</th>";
                            echo "<th>Duration Sector 2</th>";
                            echo "<th>Duration Sector 3</th>";
                            echo "<th>Lap Duration</th>";
                            echo "<th>Lap Number</th>";
                            echo "</tr>";

                            // Fetch each row of results into an array
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                                echo "<tr>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_1'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_2'] . "</td>";
                                echo "<td>" . $row['avg_duration_sector_3'] . "</td>";
                                echo "<td>" . $row['avg_lap_duration'] . "</td>";
                                echo "<td>" . $row['max_lap_number'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            // Close the database connection
                            $db->close();
                        ?>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Ruote: 
                            <?php
                                // Database connection
                                $db = new mysqli('localhost', 'root', '', 'statistiche');

                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Get data from the database
                                $pilota = $db->real_escape_string($pilota); // Assicurati che la variabile sia sicura per l'uso in una query SQL

                                $result = $db->query("
                                    SELECT
                                        t2.full_name,
                                        t1.stint_number,
                                        t1.lap_start,
                                        t1.lap_end,
                                        t1.compound,
                                        t3.session_name,
                                        t1.session_key
                                    FROM
                                        ruotedata AS t1
                                    JOIN
                                        driverdata AS t2
                                    ON
                                        t1.driver_number = t2.driver_number
                                    JOIN
                                        sessionidata AS t3
                                    ON
                                        t1.session_key = t3.session_key
                                    WHERE
                                        t3.session_name = 'Race'
                                        AND t2.full_name = '$pilota'
                                        AND t3.meeting_key = (
                                            SELECT MAX(meeting_key) FROM sessionidata
                                        )
                                    ORDER BY
                                        t2.full_name,
                                        t1.stint_number
                                ");

                                // Check if the query was successful
                                if ($result === false) {
                                die("Query failed: " . $db->error);
                                }

                                // Fetch the results into an associative array
                                $data = [];
                                while($row = $result->fetch_assoc()) {
                                    $data[$row['full_name']][$row['stint_number']] = [
                                        'laps' => $row['lap_start'] . ' - ' . $row['lap_end']. ' (Type: ' . $row['compound'] . ')',
                                        'session_key' => $row['session_key'],
                                        'session_name' => $row['session_name']
                                    ];
                                }

                                // Print the table header
                                echo "<table style='border-spacing: 10px;'>";
                                echo "<tr>";
                                echo "<th style='padding: 10px;'></th>";
                                for ($i = 1; $i <= max(array_map('count', $data)); $i++) {
                                    echo "<th style='padding: 10px;'></th>";
                                }
                                echo "</tr>";

                                // Print each row of the table
                                foreach ($data as $fullName => $stints) {
                                    echo "<tr>";
                                    echo "<td style='padding: 10px;'>" . $fullName . "</td>";
                                    foreach ($stints as $stintNumber => $stintData) {
                                        $laps = str_replace($stintData['session_name'], $stintData['session_key'], $stintData['laps']);
                                        echo "<td style='padding: 10px;'>" . $laps . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Close the database connection
                                $db->close();
                            ?>
                        </div>
                        <div class="data-item">
                            Pit: 
                            <?php
                            
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <div class="data-item">
                            Radio: <span id="radio-data"></span>
                        </div>
                        <div class="data-item">
                            Settori: <span id="settori-data"></span>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>
    </div>
    <footer class="footer mt-1">        
        <div class="col">
            <h3 class="medium-text">Contatti </h3>
            <p class="normal-text">e-mail: <br/> Fantaformula@gmail.com</p>
            <p class="normal-text">telefono: <br/> +39 3383477124</p>
        </div>
    </footer>
    
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../hamburger.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>

</body>
</html>