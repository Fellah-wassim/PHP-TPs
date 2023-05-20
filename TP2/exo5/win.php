<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <style>
      body {
        font-family: 'Press Start 2P', cursive;
        background-color: #2b2b2b;
        color: #fff;
        font-size: 16px;
        line-height: 1.5;
        padding: 0px;
      }

      h1 {
        font-size: 48px;
        margin-top: 0;
        text-align: center;
        text-shadow: 2px 2px #000;
      }

      .results, .results {
        margin: 0 auto;
        padding: 10px;
        border: 1px solid #ccc;
      }

      .results h2 {
        font-size: 26px;
        font-weight: bold;
        margin: 0 0 10px 0;
        text-align: center;
      }
      
      li{
        border-top: 1px solid #ccc;
      }

      li:first-child{
        border-top: none;
      }
      
      .results p {
        font-size: 16px;
        line-height: 1.5;
        margin: 0;
        padding: 14px 0;
      }

      a{
        font-size: 24px;
        color: #fff;
        text-shadow: 1px 1px #000;
        text-align: center;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        padding: 14px 0;
      }

      .results span.name {
        font-weight: bold;
        color: #009688;
      }

      .results span.tentatives {
        font-weight: bold;
        color: #2196F3;
      }

      .results span.duration {
        font-weight: bold;
        color: #F44336;
      }

      .flex{
        display: flex;
        justify-content: space-between;
        padding: 0px 24px;
      }
      
      .search {
        margin-top: 20px;
        text-align: center;
      }

      .search form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
      }
      
      .search label {
        margin-right: 10px;
      }

      .search input[type="text"] {
        padding: 8px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0,0,0,0.3);
      }

      .search button[type="submit"] {
        padding: 8px 16px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 0 5px rgba(0,0,0,0.3);
      }
    </style>
  </head>
  <body>
    <?php
    
      function initGame() {
        $_SESSION['number'] = rand(1, 1000);
        $_SESSION['tries'] = 0;
        $_SESSION['startTime']= microtime(true);
        $_SESSION['message'] = '';
      }

      session_start();
      function addResultsToDatabase( $name, $tentatives, $time, $date){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "exo1";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO VAINQUEURS (name, tentatives, duration, date) VALUES ('$name', '$tentatives', '$time','$date')";
        if (mysqli_query($conn, $sql)) {
          echo "<h3>New record created successfully ✅ </h3> <br>";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }    
      
      if(isset($_POST['name']) && $_SESSION['tries'] > 0  ){
        addResultsToDatabase($_POST['name'], $_SESSION['tries'], $_SESSION['duration'], $_SESSION['date']);
        $_SESSION['tries'] = 0;
      }
    ?>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "exo1";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      echo '<div class="results">';
      echo '<div class="flex">';
      echo '<h2>RECORDS</h2>';
      echo '<div class="search">';
      echo '<form method="get" action="">';
      echo '<label for="name-search">Search:</label>';
      echo '<input type="text" id="name-search" name="name" placeholder="Enter Name">';
      echo '<button type="submit">Search</button>';
      echo '</form>';
      echo '</div>';
      echo '</div>';

      $sql = "SELECT * FROM VAINQUEURS ORDER BY tentatives ASC, duration ASC, date DESC LIMIT 10";

      if(!empty($_GET['name'])) {
        $searchName = mysqli_real_escape_string($conn, $_GET['name']);
        $sql = "SELECT * FROM VAINQUEURS WHERE name LIKE '%$searchName%' ORDER BY tentatives ASC, duration ASC, date DESC LIMIT 10";
      }

      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo '<ol>';
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<li><p><span class="name">' . $row['name'] . '</span> guessed the number in <span class="tentatives">' . $row['tentatives'] . '</span> tries and it took <span class="duration">' . $row['duration'] . '</span> seconds.' . ' At '.$row['date'].'</p></li>';
        }
        echo '</ol>';
      }
        echo '</div>';
      initGame();
    ?>
    <a href="index.php">&#8592; Back</a>
  </body>
</html>
