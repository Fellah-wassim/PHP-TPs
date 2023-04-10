<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="../outputStyle.css">
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        color: #333;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <?php
      $error = "";
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $n = $_POST["n"];
        $p = $_POST["p"];
        
        if (empty($_POST['n']) || empty($_POST['p'])){
          $error = "You must enter values for both n and p.";
        }
        elseif (!ctype_digit($n) || !ctype_digit($p) || $n <= 0 || $p <= 0) {
          $error = "You must enter positive integer values.";
        }
        elseif ($n >= $p) {
          $error = "The value of n must be less than that of p.";
        }
        else {
          echo "<table>";
          echo "<tr><th></th>";
          for ($col = 1; $col <= $p; $col++) {
            echo "<th>$col</th>";
          }
          echo "</tr>";
          for ($row = 1; $row <= $n; $row++) {
            echo "<tr><th>$row</th>";
            for ($col = 1; $col <= $p; $col++) {
              echo "<td>" . ($row * $col) . "</td>";
            }
            echo "</tr>";
          }
          echo "</table>";
        }
      }
    ?>
    <?php if (!empty($error)): ?>
      <h1>Error</h1>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <a href='index.html'>&#8592; Back to Form</a>;
  </body>
</html>