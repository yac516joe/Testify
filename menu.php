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

<! -- Menu Tab -- >
<div data-role="page" id="menu-hottest">
  <div data-role="header">
    <a href="./index.php" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>Hottest Items</h1>
    <a href="./surprise.php" data-role="button" data-icon="star" >Surpise Me!</a>
  </div>

  <div data-role="content">
    <ol data-role="listview">
    <?php
      $sql = "select item_id, count(item_id) as cnt
              from rating_db 
              group by item_id
              order by cnt desc";
      $sql2;
      $tmp;
      $tmp2;

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
  </ol>
  </div>

  <div data-role="footer" data-position="fixed">
    <div data-role="navbar">
      <ul>
        <li> <a href="" class="ui-btn-active ui-state-persist"> Hottest</a> </li>
        <li> <a href="#menu-full"> Menu</a> </li>
      </ul>
    </div>  
  </div>

</div> 


<div data-role="page" id="menu-full">
  <div data-role="header">
    <a href="./index.php" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>82 Dishes in Total</h1>
    <a href="./surprise.php" data-role="button" data-icon="star" >Surpise Me!</a>
  </div>

  <div data-role="content">
    <?php
  //Attempy query execution
  $sql = "select * from categories_db";
  $sql2;
  $tmp;
  $tmp2;

  if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
      while($row = $result->fetch_array()) {
        echo  "<div data-role='collapsible'><h4>" . $row[1] . "</h4>";
        echo "<ul data-role='listview'>";
        $sql2 = "select * from cuisine_db where category = " . $row[0];
        if ($tmp = $mysqli->query($sql2)) {
          while ($tmp2 = $tmp->fetch_array()) {
            echo "<li><a href='#'>" . $tmp2[2] . "</a></li>";
          }
        }
        echo "</ul></div>";
      }
      $result->close();
    } else {
      echo "No reords matching your query were found.";
    }
  } else {
    echo "Error: could not execute $sql. " . $mysqli->error;
  }

  ?>


  </div>

  <div data-role="footer" data-position="fixed">
    <div data-role="navbar">
      <ul>
        <li> <a href="#menu-hottest"> Hottest</a> </li>
        <li> <a href="" class="ui-btn-active ui-state-persist"f> Menu</a> </li>
      </ul>
    </div>  
  </div>

</div> 


</body>
</html>
