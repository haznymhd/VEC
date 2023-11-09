<?php
session_start();

// Establish database connection
$connection = mysqli_connect("localhost", "username", "password", "your_database_name");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve login credentials
$username = mysqli_real_escape_string($connection, $_POST["username"]);
$password = $_POST["password"]; // Don't sanitize, as we'll verify the password

// Construct and execute SQL query
$query = "SELECT id, password FROM users WHERE username = '$username'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row["password"];

    if (password_verify($password, $hashedPassword)) {
        $_SESSION["user_id"] = $row["id"]; // Store user ID in session
        header("Location: welcome.php"); // Redirect to welcome page
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

// Close the database connection
mysqli_close($connection);
?>
