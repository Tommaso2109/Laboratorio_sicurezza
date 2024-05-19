<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$url = "https://api.openf1.org/v1/sessions?meeting_key=latest"; // JSONPlaceholder API URL

// Using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    // cURL error
    //echo 'cURL error: ' . curl_error($ch);
} else {
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($status >=200 && $status < 300) {
        // Successful response
        $data = json_decode($response, true); // Assuming the API returns a JSON

        // Database connection
        $db = new mysqli('localhost', 'root', '', 'statistiche');

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Prepare data for database
        foreach ($data as $session) {           
            $session_key = $session['session_key'];
            $year = $session['year'];
            $session_name = $session['session_name'];
            $meeting_key = $session['meeting_key'];
    
            // Prepare an SQL statement
            $stmt = $db->prepare("
                INSERT INTO sessionidata (session_key, year, session_name, meeting_key)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    year = VALUES(year),
                    session_name = VALUES(session_name),
                    meeting_key = VALUES(meeting_key)
            ");
    
            // Bind parameters
            $stmt->bind_param("siss", $session_key, $year, $session_name, $meeting_key);
    
            // Execute the statement
            if (!$stmt->execute()) {
                die("Query failed: " . $stmt->error);
            }        
        }
        
    }
    // Close the database connection
    $db->close();
}