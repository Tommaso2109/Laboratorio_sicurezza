<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    $conn = new mysqli('127.0.0.1', 'root', '', 'statistiche');

            if ($conn->connect_error) {
                die('Errore di connessione (' . $conn->connect_errno . ') ' . $conn->connect_error);
            }

            $sql = "SELECT ban FROM utenti WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
    if($row['ban'] == 0){
    $sql = "UPDATE utenti SET ban = 1 WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    // Reindirizza l'utente alla pagina "segnala utente"
    header('Location: pagina_personale.php');
    }
    else{
        $sql = "UPDATE utenti SET ban = 0 WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        // Reindirizza l'utente alla pagina "pagina personale"
        header('Location: pagina_personale.php'); 
    }
    exit;

}