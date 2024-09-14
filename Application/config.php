<?php
// Database configuration
$servername = "localhost";  // Default for XAMPP
$username = "root";         // Default for XAMPP
$password = "";             // Default for XAMPP (no password)
$dbname = "student_management"; // Your database name
$conn = "";

// Create a connection to the MySQL database
try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // echo "Connected successfully";
} catch (mysqli_sql_exception) {
    die("Could not connect!");
}
