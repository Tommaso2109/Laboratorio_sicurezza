<?php
    // Start the session
    session_start();

    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Connect to the database
    $conn = new mysqli('127.0.0.1', 'root', '', 'statistiche');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user and password from POST request
    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Protect against SQL injection
    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Check if the user exists and the password is correct
    $sql = "SELECT * FROM utenti WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User exists and password is correct, handle this case
        $_SESSION['username'] = $user;
        echo json_encode(["success" => "Login successfull!"]);
    } else {
        // User does not exist or password is incorrect, handle this case
        echo json_encode(["error" => "Questo user non è iscritto, Registrati! Oppure la password è errata."]);
    }
    $conn->close();
?>