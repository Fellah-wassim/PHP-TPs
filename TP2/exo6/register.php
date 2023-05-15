<?php
  session_start();
  $loggedIn = false;

  // check if user is already logged in
  if (isset($_SESSION['username'])) {
    $loggedIn = true;
    header("Location: lottery.php");
    exit();
  }

  // handle registration form submission
  if (isset($_POST['register'])) {
    
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // connect to database
    $connection = mysqli_connect('localhost', 'root', '', 'exo2');

    // check if connection was successful
    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // check if the entered username already exists in the PLAYERS table
    $query = "SELECT * FROM JOUEURS WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
      // username already exists,
      $errorMessage = "Username already exists. Please choose a different username.";
    } else {
      // insert user's information into the PLAYERS table
      $insertQuery = "INSERT INTO JOUEURS (first_name, last_name, username, password) VALUES ('$firstName', '$lastName', '$username', '$password')";
      $insertResult = mysqli_query($connection, $insertQuery);

      if ($insertResult) {
        $_SESSION['username'] = $username;
        header("Location: lottery.php");
        exit();
      } else {
        // registration failed, display error message
        $errorMessage = "Registration failed. Please try again later.";
      }
    }
    
    // close database connection
    mysqli_close($connection);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #1b1b1b;
      color: #fff;
      font-family: Arial, sans-serif;
      font-size: 16px;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      width: 50%;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      border-radius: 5px;
      background-color: #333;
      text-align: center;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 30px;
    }

    form {
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      display: block;
      font-size: 24px;
      margin-bottom: 10px;
      text-align: left;
    }

    input[type="text"],
    input[type="password"] {
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
      padding: 10px;
      width: auto;
      padding: 16px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: none;
      width: -webkit-fill-available;
    }

    button[type="submit"] {
      padding: 10px 20px;
      margin-top: 16px;
      border-radius: 5px;
      border: none;
      background-color: #16a085;
      color: #fff;
      font-size: 24px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #3e8e41;
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
</head>
<body>
  <div class="container">
    <h1>Register</h1>
    <form method="post">
      <div class="form-group">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" name="register">Register</button>
    </form>
    <?php if (isset($errorMessage)) { ?>
      <p class="error"><?php echo $errorMessage; ?></p>
    <?php } ?>
    <p>Already have an account? <a href="index.php">Login here</a></p>
  </div>
</body>
</html>