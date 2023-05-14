<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>Exo 4 - Results</title>
  </head>
  <body>
    <h1>Results</h1>

    <?php
    // Get the input values from the form
    $balance = $_POST["balance"];
    $interest = $_POST["interest"];
    $years = $_POST["years"];
    $error = "";

    // Check if input values are empty
    if (empty($balance)) {
      $error = "You must enter your initial balance.";
    } elseif (empty($interest)) {
      $error = "An interest rate must be selected.";
    } elseif (empty($years)) {
      $error = "The number of years must be selected.";
    } else {
      $final_balance = $balance;
      $interest_decimal = $interest / 100;
      for($index=1; $index<=$years; $index++){
        $final_balance = $final_balance+($final_balance * $interest_decimal);
      }
      echo "<p>You final sold is $final_balance </p>";

    }
    ?>
    <?php if (!empty($error)): ?>
      <h1>Error</h1>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <a href='index.html'>&#8592; Back to Form</a>;

  </body>
</html>