<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>

<?php
      $mysqli = new mysqli("localhost", "root","","Tastify");
        if ($mysqli == false) {
          die("Error: Could not connect. " . mysql_connect_error());
        } else {
          echo "<br>" . "Connection Success" . "<br>";
        }
    ?>  

<! -- Surprise Tab -- >
<div data-role="page" id="surprise">
  <div data-role="header">
    <a href="./index.php" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>Recommendation based on your preference</h1>
    <a href="./menu.php" data-role="button" data-icon="info" >Check the Menu</a>
  </div>

  <div data-role="content">
  	<ul data-role="listview">
    <?php
      require './OpenSlopeOne.php';
      $slopeone = new OpenSlopeOne();
	  $slopeone->initSlopeOneTable('MySQL');

	  $sql = "select s.item_id2 from slope_one s,rating_db u 
	  			where u.user_id = 3 
	  			and s.item_id1 = u.item_id and s.item_id2 != u.item_id group by s.item_id2 order by sum(u.rating * s.times - s.rating)/sum(s.times) desc limit 10";
	  if ($result = $mysqli->query($sql)) {
			if ($result->num_rows > 0){
          while ($row = $result->fetch_array()) {
            $sql2 = "select name from cuisine_db where id = ". $row[0];
            if ($tmp = $mysqli->query($sql2)) {
              if ($tmp2 = $tmp->fetch_array()) {
                echo "<li><a>". $tmp2[0] . "</a></li>";
              }
            }
          }
        }
	  }

    ?>  
	</ul>
  </div>

  <div data-role="footer">
    <div data-role="navbar">
    </div>  
  </div>

</div> 


</body>
</html>
