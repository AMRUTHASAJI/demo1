<?php
// Start the session to access session variables
session_start();

// Database connection parameters
$host = "localhost"; // Change this if your MySQL server is on a different host
$username = "amrita";
$password = "crystalSNOW@123";
$database = "db2"; // Change this to your database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the login form

$email = $_POST['email']; // Replace 'email' with the name attribute of your email field
$password = $_POST['password']; // Replace 'password' with the name attribute of your password field

// Prepare a SQL statement to retrieve the user from the database
$sql = "SELECT * FROM registration WHERE email = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the user exists and the password is correct

if ($result->num_rows == 1) {
    // Fetch the user's first name and last name
    $row = $result->fetch_assoc();
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];

    // Display a welcome message with the user's first and last name
    echo "Welcome back, $first_name $last_name!";
} else {
    // User not found or invalid email/password
    echo "Invalid email or password";
}


// Close the statement and the connection
$stmt->close();
$conn->close();
?>