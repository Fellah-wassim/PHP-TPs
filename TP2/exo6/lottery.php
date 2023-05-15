<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>      
    body {
      font-family: 'Press Start 2P', cursive;
      background-color: #2b2b2b;
      color: #fff;
      font-size: 16px;
      line-height: 1.5;
      padding: 20px;
    }

    h1{
      text-align: center;
    }
    
    table {
      border-collapse: collapse;
    }

    td {
      width: 60px;
      height: 60px;
      text-align: center;
      border: 1px solid #ccc;
    }

    form{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    label {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5px;
      cursor: pointer;
      font-size: 18px;
      width: 60px;
      height: 60px;
      font-weight: bold;
    }

    input[type=submit], button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button{
      margin-top: 0;
    }

    p{
      margin: 10px 0;
      font-size: 24px;
    }

    .head {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .username {
      font-weight: bold;
      color: #4CAF50;
      text-transform: uppercase;
    }
  </style>
  <title>Exo 6</title>
</head>
<body>
  <?php
    session_start();
    $loggedIn = isset($_SESSION['username']);
  ?>
  <?php if ($loggedIn) { ?>
    <div class="head">
      <p>You are logged in as <span class="username"><?php echo $_SESSION['username']; ?></span>.</p>
      <form action="logout.php" method="post">
        <button type="submit">Logout</button>
      </form>
    </div>
  <?php }?>
  <h1>Lottery</h1>
  <form method="post">
    <table>
      <?php
        for ($i = 1; $i <= 7; $i++) {
          echo "<tr>";
          for ($j = 1; $j <= 7; $j++) {
            $number = ($i - 1) * 7 + $j;
            echo "<td><label><input type='checkbox' name='numbers[]' value='$number'> $number</label></td>";
          }
          echo "</tr>";
        }
      ?>
    </table>
    <div>
      <input type="submit" name="submit" value="Submit">
      <input type="submit" name="reset" value="Reset">
    </div>
  </form>

  <?php
    if (isset($_POST['submit']) && isset($_POST['numbers'])) {

      $selectedNumbers = $_POST['numbers'];
      $numSelected = count($selectedNumbers);

      if ($numSelected != 6) {
        echo "Please select exactly 6 numbers";
      } else {

        $winningNumbers = array();
        while (count($winningNumbers) < 6) {
          $randomNumber = rand(1, 49);
          if (!in_array($randomNumber, $winningNumbers)) {
            $winningNumbers[] = $randomNumber;
          }
        }

        $selectedNumbers = $_POST['numbers'];
        $numMatches = 0;

        foreach ($selectedNumbers as $number) {
          if (in_array($number, $winningNumbers)) {
            $numMatches++;
          }
        }

        $winningMessage = "<p>The winning numbers are: " . implode(", ", $winningNumbers) ."</p>";
        $selectedMessage = "<p>You selected: " . implode(", ", $selectedNumbers) ."</p>";
        $numMatchesMessage = "<p>Number of matches: $numMatches</p>";

        if (isset($_POST['reset'])) {
          unset($winningMessage);
          unset($selectedMessage);
          unset($numMatchesMessage);
        }
        
        echo $winningMessage. $selectedMessage. $numMatchesMessage;
      }
    }
  ?>
</body>
</html>