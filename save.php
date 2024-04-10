<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: login.html");
    exit();
}

// Database connection parameters
$host = "localhost"; // Change this if your MySQL server is on a different host
$username = "amrita";
$password = "crystalSNOW@123";
$database = "db2"; // Change this to your database name
$table = "registration"; // Change this to your table name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the registration form
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_SESSION['email'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];

// Prepare a SQL statement to insert the user into the database
$sql = "INSERT INTO $table (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssss", $firstName, $lastName, $email, $phoneNumber, $password);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful. You can now <a href='login.html'>login</a>.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

