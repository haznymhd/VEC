<?php
include 'php/db_connection.php'; 

$registrationMessage = "";

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $query = "INSERT INTO users (full_name, email, username, password) VALUES ('$fullName', '$email', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        $userID = mysqli_insert_id($conn); // Get the auto-generated User ID
        $registrationMessage = "Registration successful! Your User ID is: $userID";
    } else {
        $registrationMessage = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Account - Virtual Examination Center</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional CSS for registration form */
        body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url("image/background.jpg");
      background-size: cover;
      background-position: center;
    }

    .background-blur {
      background-color: rgba(0, 0, 0, 0.5);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-container {
      text-align: center;
      background-color: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      width: 400px;
    }

    .signup-container h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .input-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #555;
    }

    .input-group input,
    .input-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .signup-link {
      margin-top: 15px;
      color: #555;
    }

    .signup-link a {
      color: #007bff;
      text-decoration: none;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<div class="background-blur">
    <div class="signup-container">
        <h2>Create Account</h2>
        <?php if (!empty($registrationMessage)): ?>
            <p><?php echo $registrationMessage; ?></p>
        <?php endif; ?>
        <form action="" method="post" id="signupForm">
            <div class="input-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="userType">User Type</label>
                <select id="userType" name="userType">
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                    <option value="lecturer">Lecturer</option>
                </select>
            </div>
            <button class="btn-primary" type="submit" name="submit">Create Account</button>
        </form>
        <p class="signup-link">Already have an account? <a href="welcome-page.php">Login</a></p>
    </div>
</div>
</body>
</html>
