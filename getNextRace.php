<?php
// Connessione al database
$conn = new mysqli('127.0.0.1', 'root', '', 'statistiche');

// Controllo connessione
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Esegui la query per ottenere la prossima gara
$sql = "SELECT Data FROM nextGare ORDER BY Data LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output della prima riga
    echo $result->fetch_assoc()['Data'];
} else {
    echo "Nessuna gara trovata";
}

$conn->close();
?>