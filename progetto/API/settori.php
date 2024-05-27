<?php
    // Database connection
    $db = new mysqli('localhost', 'root', '', 'statistiche');

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Get data from the database
    $pilota = $db->real_escape_string($_GET['pilota']); // Assicurati che la variabile sia sicura per l'uso in una query SQL

    $result = $db->query("
        SELECT DISTINCT f.driver_number, f.message, d.full_name 
        FROM flagsdata f 
        JOIN driverdata d ON f.driver_number = d.driver_number 
        JOIN sessionidata s ON f.meeting_key = s.meeting_key
        WHERE d.full_name = '$pilota'
        AND s.meeting_key = (
            SELECT MAX(meeting_key) 
            FROM sessionidata
        ) 
        AND s.session_name = 'Race'
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
?>