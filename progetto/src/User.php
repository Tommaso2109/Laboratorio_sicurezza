<?php

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $email, $password) {
        // Protect against SQL injection
        $username = mysqli_real_escape_string($this->conn, $username);
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user already exists
        $sql = "SELECT * FROM utenti WHERE username = '$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // User exists, handle this case
            return 'User already registered. Please Login';
        } else {
            // User does not exist, insert new user
            $defaultImage = 'media/profilo_vuoto.jpg';
            $sql = "INSERT INTO utenti (username, email, password, profile_image) VALUES ('$username', '$email', '$password', '$defaultImage')";

            if ($this->conn->query($sql) === TRUE) {
                // Registration successful
                return 'Thanks for register :)';
            } else {
                // Registration failed
                return "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }
}