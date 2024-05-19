<?php
    // Database connection
    $db = new mysqli('localhost', 'root', '', 'statistiche');

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

     // Verifica se il parametro 'pilota' è presente
     if (!isset($_GET['pilota'])) {
        die("Parameter 'pilota' is missing");
    }
    
    // Assegna il parametro 'pilota' a una variabile
    $pilota = $_GET['pilota'];

    // Get data from the database
    $result = $db->query("
        SELECT DISTINCT
            filtered.driver_number,
            filtered.recording_url,
            t2.full_name
        FROM
            (
                SELECT
                    t1.driver_number,
                    t1.recording_url
                FROM
                    teamRadio AS t1
                JOIN
                    sessioniData AS t3
                ON
                    t1.session_key = t3.session_key
                WHERE
                    t3.session_name = 'Race'
            ) AS filtered
        JOIN
            driverdata AS t2
        ON
            filtered.driver_number = t2.driver_number
        WHERE
            t2.full_name = '$pilota'
    ");

    // Check if the query was successful
    if ($result === false) {
        die("Query failed: " . $db->error);
    }

    // Fetch the results into an associative array
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Close the database connection
    $db->close();

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);

