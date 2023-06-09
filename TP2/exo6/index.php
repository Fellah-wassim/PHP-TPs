<?php
  session_start();
  $loggedIn = false;

  // check if user is already logged in
  if (isset($_SESSION['username'])) {
    $loggedIn = true;
    header("Location: lottery.php");
    exit();
  }

  // handle login form submission
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // connect to database
    $connection = mysqli_connect('localhost', 'root', '', 'exo2');

    // check if connection was successful
    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // check if the entered username and password match any record in the PLAYERS table
    $query = "SELECT * FROM JOUEURS WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $query);
    

    if (mysqli_num_rows($result) > 0) {
      // login successful, set session variable and redirect to lottery game page
      $_SESSION['username'] = $username;
      header("Location: lottery.php");
      exit();
    } else {
      // login failed, display error message
      $errorMessage = "Invalid username or password.";
    }

    // close database connection
    mysqli_close($connection);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #222;
      color: #fff;
      font-family: Arial, sans-serif;
      text-align: center;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .container {
      width: 50%;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      border-radius: 5px;
      background-color: #333;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 30px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    label {
      font-size: 24px;
      margin-bottom: 10px;
      text-align: left;
    }

    input {
      padding: 16px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: none;
      background-color: #fff;
      color: #222;
    }

    button {
      padding: 10px 20px;
      margin: 0 auto;
      border-radius: 5px;
      border: none;
      background-color: #16a085;
      color: #fff;
      font-size: 24px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #3e8e41;
    }

    p {
      margin-top: 30px;
      font-size: 16px;
    }

    a {
      color: #16a085;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .error {
      color: #c0392b;
      font-size: 18px;
    }
    
  </style>  
  </style>
</head>
<body>
  <div class="container">
    <form method="post" class="login-form">
      <h1>Login</h1>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" name="submit" class="btn">Login</button>
      <?php if (isset($errorMessage)) { ?>
        <p class="error"><?php echo $errorMessage; ?></p>
      <?php } ?>
      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
  </div>
</body>
</html>