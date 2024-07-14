<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch user based on email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password correct, start session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            // Redirect to home page or any other authenticated page
            header("Location: index.html");
            exit();
        } else {
            // Incorrect password
            $message = "Wrong Password";
        }
    } else {
        // No user found with the provided email
        $message = "No User found";
    }

    // Redirect with error message to mine.php
    header("Location: mine.php?message=" . urlencode($message));
    exit();
}

$conn->close();
?>
