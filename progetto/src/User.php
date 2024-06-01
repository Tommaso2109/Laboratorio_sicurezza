<?php

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($username, $password)
    {
        // Connect to the database
        $conn = new mysqli('127.0.0.1', 'root', '', 'statistiche');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the user already exists
        $stmt = $conn->prepare("SELECT * FROM utenti WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User already exists
            return 'User already exists';
        }

        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO utenti (username, password) VALUES (?, ?)");

        // Bind the parameters
        $stmt->bind_param('ss', $username, $password);

        // Return true without executing the query
        return true;
    }
}

?>