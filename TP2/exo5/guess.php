<?php
session_start();

if (!isset($_SESSION['number'])) {
  $_SESSION['number'] = rand(1, 1000);
}

$guess = null;
$message = '';

if (isset($_POST['guess'])) {
  $guess = intval($_POST['guess']);
  if ($guess < 1 || $guess > 1000) {
    $message = 'Please enter a number between 1 and 1000.';
  } elseif ($guess < $_SESSION['number']) {
    $message = 'Too small, try again.';
  } elseif ($guess > $_SESSION['number']) {
    $message = 'Too big, try again.';
  } else {
    $message = 'Congratulations, you guessed the right number!';
    $_SESSION['number'] = null;
  }
}

if (isset($_POST['restart'])) {
  $_SESSION['number'] = null;
  $message = '';
  $guess = null;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Guess the number</title>
    <style>
      body {
        font-family: 'Press Start 2P', cursive;
        background-color: #2b2b2b;
        color: #fff;
        font-size: 16px;
        line-height: 1.5;
        padding: 20px;
      }

      h1 {
        font-size: 48px;
        margin-top: 0;
        text-align: center;
        text-shadow: 2px 2px #000;
      }

      form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
      }

      label {
        font-size: 24px;
        margin-bottom: 10px;
        text-shadow: 2px 2px #000;
      }

      input {
        background-color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 24px;
        padding: 10px;
        text-align: center;
        width: 200px;
        margin-bottom: 10px;
      }

      button {
        background-color: #4CAF50;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        font-size: 24px;
        padding: 10px;
        margin-top: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        transition-duration: 0.4s;
        text-shadow: 1px 1px #000;
      }

      button:hover {
        background-color: #3e8e41;
      }

      .message {
        font-size: 24px;
        margin-top: 20px;
        text-align: center;
        text-shadow: 2px 2px #000;
      }

    </style>
  </head>
  <body>
    <h1>Guess the number</h1>
    <?php if ($message) { ?>
      <p class="message"><?php echo $message; ?></p>
    <?php } ?>
    <form method="post">
      <label for="guess">Enter your guess (between 1 to 1000):</label>
      <input type="number" id="guess" name="guess" value="<?php echo $guess; ?>">
      <div style="display:flex; gap:10px;">
      <button type="submit">Submit</button>
      <button type="submit" name="restart">Restart</button>
      </div>
  </body>
</html>