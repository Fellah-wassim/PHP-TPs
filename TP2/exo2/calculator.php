<!DOCTYPE html>
<html>
  <head>
    <title>Calculator Result</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        color: #333;
        margin: 0;
        padding: 0;
      }

      h1 {
        text-align: center;
        font-size: 36px;
        margin-top: 50px;
      }

      table {
        border-collapse: collapse;
        margin: 50px auto;
        font-size: 16px;
      }

      th,
      td {
        border: 1px solid black;
        padding: 10px;
        text-align: center;
      }

      th {
        background-color: #4caf50;
        color: white;
      }

      p {
        text-align: center;
        font-size: 24px;
        margin-top: 30px;
      }

      a {
        display: block;
        text-align: center;
        margin-top: 50px;
      }

      .error {
        color: red;
        margin: 20px;
      }
    </style>
  </head>
  <body>
    <?php
      if (isset($_GET['operand1']) && isset($_GET['operand2']) && isset($_GET['operator']) &&
        !empty($_GET['operand1']) && !empty($_GET['operand2']) && !empty($_GET['operator'])) {
        
        $operand1 = $_GET['operand1'];
        $operand2 = $_GET['operand2'];
        $operator = $_GET['operator'];

        switch($operator) {
          case "+":
            $result = $operand1 + $operand2;
            break;
          case "-":
            $result = $operand1 - $operand2;
            break;
          case "x":
            $result = $operand1 * $operand2;
            break;
          case "/":
            if ($operand2 == 0) {
              $error = "Impossible! Division by zero.";
            } else {
              $result = $operand1 / $operand2;
            }
            break;
          default:
            $error = "Invalid operator!";
        }
      } else {
        $error = "The two operands and operator must be entered.";
      }
    ?>
    <?php if (isset($error)) { ?>
      <h1>Error</h1>
      <p class="error"><?php echo $error; ?></p>
    <?php } else { ?>
      <h1>Calculation Result</h1>
      <p>The result of <?php echo $operand1 . " " . $operator . " " . $operand2 . " is  <span style='font-weight:bold; font-size:24px'>" . $result . "</span>" ?></p>
    <?php } 
    echo "<a href='index.html'>&#8592; Back to Form</a>";
    ?>
  </body>
</html>