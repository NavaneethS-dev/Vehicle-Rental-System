<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['signup_email'];
    $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fname, lname, phone, email, password) VALUES ('$fname', '$lname', '$phone', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo '<script>alert("Registration successful!");</script>';
        echo '<script>window.location.href = "mine.html";</script>';
        exit();
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
