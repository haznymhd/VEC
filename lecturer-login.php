<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['username']; // Update the variable name
    $password = $_POST['password'];

    $query = "SELECT password FROM users WHERE id = ?"; // Update table name
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id); // Use "i" for integer parameter
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['user_id'] = $user_id; // Store user ID in session for authentication
                    header("Location: dash-board/lecturer-dash/lecturer-dashboard.php"); // Redirect to lecturer dashboard
                    exit();
                } else {
                    $_SESSION['login_message'] = "Login unsuccessful!";
                }
            } else {
                $_SESSION['login_message'] = "User ID not found!";
            }
        } else {
            $_SESSION['login_message'] = "Error retrieving user data!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['login_message'] = "Database error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lecturer Login - Virtual Examination Center</title>
  <link rel="stylesheet" href="styles.css"> <!-- Include the CSS file -->
  <style>
    /* Additional CSS to center content */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }
    .login-container {
      text-align: center;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Lecturer Login</h2>
    <?php
    if (isset($_SESSION['login_message'])) {
        echo '<p>' . $_SESSION['login_message'] . '</p>';
        unset($_SESSION['login_message']);
    }
    ?>
    <form id="lecturerLoginForm" action="lecturer-login.php" method="post">
      <label for="username">User ID:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button class="btn-primary" type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Create now</a></p>
  </div>
  <!-- Include JavaScript file if needed -->
  <script>
    document.getElementById("lecturerLoginForm").addEventListener("submit", function(event) {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;

      if (username === "" || password === "") {
        event.preventDefault();
        alert("Both username and password are required!");
      }
    });
  </script>
</body>
</html>
