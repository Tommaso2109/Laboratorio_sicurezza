<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$url = "https://api.openf1.org/v1/pit?meeting_key=latest"; // JSONPlaceholder API URL

//print_r($url . "\n");
// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Get HTTP status code
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    // cURL error
    //echo 'cURL error: ' . curl_error($ch);
} else {
    if ($status >= 200 && $status < 300) {
        // Successful response
        $data = json_decode($response, true); // Assuming the API returns a JSON

        // Print the data
        //echo "Decoded Data: <br>";
        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
    } elseif ($status == 500) {
        //echo "The server encountered an internal error. Please try again later.";
    } else {
        //echo "An error occurred. HTTP Status Code: " . $status;
    }
}

// Crea connessione al database
$conn = new mysqli('localhost', 'root', '', 'statistiche');

// Controlla la connessione
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Itera attraverso ogni elemento nell'array dei dati
foreach ($data as $row) {
    // Controlla se pit_duration è nullo
    if (is_null($row['pit_duration'])) {
        continue; // Salta questa iterazione se pit_duration è nullo
    }

    $date = $row['date'];
    $driver_number = $row['driver_number'];
    $lap_number = $row['lap_number'];
    $meeting_key = $row['meeting_key'];
    $pit_duration = $row['pit_duration'];
    $session_key = $row['session_key'];

    // Prima di inserire, controlla se la session_key corrisponde a una sessione con nome 'Race' e se meeting_key è il massimo meeting_key
    $checkSql = "SELECT * FROM sessioniData WHERE session_key = ? AND session_name = 'Race' AND meeting_key = (SELECT MAX(meeting_key) FROM sessioniData)";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $session_key);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Query SQL per inserire i dati nel database
        $pit_duration_float = floatval($pit_duration);
        if ($pit_duration !== null && $pit_duration_float != 999.99 && $date !== null && $driver_number !== null && $lap_number !== null && $meeting_key !== null && $session_key !== null) {
            $sql = "INSERT INTO pitData (date, driver_number, lap_number, meeting_key, pit_duration, session_key) 
                    VALUES (?, ?, ?, ?, ?, ?)
                    ";
            // Esegui la query qui
    
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siisss", $date, $driver_number, $lap_number, $meeting_key, $pit_duration, $session_key);
            if (!$stmt->execute()) {
                //echo "Error: " . $stmt->error;
            }
        }
    }
}

// Chiudi la connessione
$conn->close();