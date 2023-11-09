<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Virtual Examination Center</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }
    .container {
      text-align: center;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .logo {
      max-width: 100px;
      margin-bottom: 20px;
    }
    .title {
      color: #333;
      font-size: 24px;
      margin-bottom: 20px;
    }
    .btn-group {
      margin-bottom: 20px;
    }
    .btn-primary {
      display: inline-block;
      padding: 10px 20px;
      margin: 5px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .create-account {
      color: #777;
    }
  </style>
</head>
<body>
  <div class="container">
    <img class="logo" src="image/logo.png" alt="Logo">
    <h1 class="title">Welcome to the Virtual Examination Center</h1>
    <div class="btn-group">
      <a class="btn-primary" href="admin-login.php">Admin Login</a>
      <a class="btn-primary" href="student-login.php">Student Login</a>
      <a class="btn-primary" href="lecturer-login.php">Lecturer Login</a>
    </div>
    <p class="create-account">Don't have an account? <a href="register.php">Create now</a></p>
  </div>
</body>
</html>
