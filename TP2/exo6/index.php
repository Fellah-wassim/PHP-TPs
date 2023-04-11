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
    
    table {
      border-collapse: collapse;
    }

    td {
      width: 60px;
      height: 60px;
      text-align: center;
      border: 1px solid #ccc;
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

    input[type=submit] {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    p{
      margin: 10px 0;
    }
  </style>
  <title>Exo 6</title>
</head>
<body>
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
    <input type="submit" name="submit" value="Submit">
    <input type="submit" name="reset" value="Reset">
  </form>
  <?php
    if (isset($_POST['submit'])) {
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
        $numMatchesMessage = "Number of matches: $numMatches";
        
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