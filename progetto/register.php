<?php
require 'vendor/autoload.php';
class Register {
    private $conn;

    public function __construct() {
        // Connect to the database
        $this->conn = new mysqli('127.0.0.1', 'root', '', 'statistiche');

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerUser() {
        // Get user, password and email from POST request
        $user = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $pass = isset($_POST['password']) ? $_POST['password'] : '';

        // Protect against SQL injection
        $user = mysqli_real_escape_string($this->conn, $user);
        $email = mysqli_real_escape_string($this->conn, $email);
        $pass = mysqli_real_escape_string($this->conn, $pass);

        // Hash the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        // Check if the user already exists
        $sql = "SELECT * FROM utenti WHERE username = '$user'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // User exists, handle this case
            $this->userExists();
        } else {
            // User does not exist, insert new user
            $defaultImage = 'media/profilo_vuoto.jpg';
            $sql = "SELECT email FROM utenti WHERE email = '$email'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0){
                // Email already exists, handle this case
                $this->emailExists();
            }else{
                $sql = "INSERT INTO utenti (username, email, password,profile_image) VALUES ('$user', '$email', '$pass','$defaultImage')";

                if ($this->conn->query($sql) === TRUE) {
                    // Registration successful, redirect to a success page
                    $this->registrationSuccess();
                } else {
                    // Error occurred, redirect to an error page
                    echo "Error: " . $sql . "<br>" . $this->conn->error;
                }
            }
        }
        $this->conn->close();
    }

    private function userExists() {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>login.formula1forfun</title>";
        echo '<link rel="stylesheet" href="styleLogin.css">';
        echo "</head>";
        echo "<body>";
        echo '<div class="sfondo"></div>';
        echo '<div class = "box">';
        echo '<a href="index.php">';
        echo '<img src="media/logo.png" alt="logo">';
        echo '</a>';
        echo '<form>';
        echo '<label for="login">User already registered. Please Login</label><br>';
        echo '<a href="loginStart.php" class="login" style="font-size: 20px"> Login </a>';
        echo '</form>';
        echo '</div>';
        echo "</body>";
        echo "</html>";
    }

    private function emailExists() {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>login.formula1forfun</title>";
        echo '<link rel="stylesheet" href="styleLogin.css">';
        echo "</head>";
        echo "<body>";
        echo '<div class="sfondo"></div>';
        echo '<div class = "box">';
        echo '<a href="index.php">';
        echo '<img src="media/logo.png" alt="logo">';
        echo '</a>';
        echo '<form>';
        echo '<label for="login" style="text-align: center">Email already been used. <br><br>Please use another email or Login</label><br>';
        echo '<a href="loginStart.php" class="login" style="font-size: 20px"> Login </a>';
        echo '</form>';
        echo '</div>';
        echo "</body>";
        echo "</html>";
    }

    private function registrationSuccess() {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>login.formula1forfun</title>";
        echo '<link rel="stylesheet" href="styleLogin.css">';
        echo "</head>";
        echo "<body>";
        echo '<div class="sfondo"></div>';
        echo '<div class = "box">';
        echo '<a href="index.php">';
        echo '<img src="media/logo.png" alt="logo">';
        echo '</a>';
        echo '<form>';
        echo '<label for="login">Thanks for register :)</label><br>';
        echo '<a href="loginStart.php" class="login" >You can Login here</a><br>';
        echo '</form>';
        echo '</div>';
        echo "</body>";
        echo "</html>";
    }
}

// Create a new Register object and call the registerUser method
$register = new Register();
$register->registerUser();
?>