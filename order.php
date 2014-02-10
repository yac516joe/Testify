<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Your Order</title> 
<link rel="stylesheet" href="./css/jquery.mobile-1.3.1.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>
  <! -- Orders Tab -- >
  <div data-role="page" id="index">
    <div data-role="header">
      <h1>Your Order</h1>
      <a href="#" data-role="button" data-icon="arrow-r" >Submit the Order</a>
    </div>

    <div data-role="content">
      <?php
        $mysqli = new mysqli("localhost", "root","","Tastify");
        if ($mysqli == false) {
          die("Error: Could not connect. " . mysql_connect_error());
        } 

        if(isset($_SESSION['cart'])){
          $ids = "";
          foreach($_SESSION['cart'] as $id){
            $ids = $ids . $id . ",";
          }
            
          // remove the last comma
          $ids = rtrim($ids, ',');
            
          $sql = "SELECT * FROM cuisine_db WHERE id IN ({$ids})";

          echo "<ul data-role='listview' data-inset='true'>";

          if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
              $price_sum=0;
              while($row = $result->fetch_array()) {
                echo "<li><a href='#'>
                    <h2>" .$row[2] . "</h2>
                    <p>£" . $row[3] . "</p>
                    </a>
                    <a href='removeFromCart.php?id={$row[0]}&name={$row[2]}'>Remove From Order</a>
                  </li>";

                $price_sum = $price_sum + $row[3];
                }
              echo "</ul>";
              $result->close();
            } else {
              echo "You haven't order anything yet";
            }
          } else {
            echo "You haven't order anything yet";
          }
        } else {
          echo "You haven't order anything yet";
        }
      ?>   
      
    </div>

    <div data-role="footer" data-position="fixed">
      <div data-role="navbar">
      <ul>
        <li> <a>In Total: <?php echo $price_sum?></a> </li>
      </ul>
      </div> 
    </div>
  </div> 
</body>
</html>