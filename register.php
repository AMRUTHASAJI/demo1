<?php
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

// Get data from the registration form
// Assuming you have form fields named 'username' and 'password'
$first_name = $_POST["firstName"];
$last_name = $_POST["lastName"];
$email = $_POST["email"];
$phone_number = $_POST["phoneNumber"];
$password = $_POST["password"];
$confirm_password = $_POST["confirmPassword"];

// Hash the password before storing it in the database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare a SQL statement to insert the user into the database
$sql = "INSERT INTO registration (first_name, last_name, email, phone_number, password) VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<p>Registration Successful. Hello $first_name $last_name, your account has been created. Details have been sent to your email id $email</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ss", $username, $hashed_password);

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
