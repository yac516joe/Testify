<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Tastify</title> 
<link rel="stylesheet" href="./css/jquery.mobile-1.3.1.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>

<! -- Index Tab -- >
<div data-role="page" id="index">
  <div data-role="header">
    <a href="#panel-01" data-role="button" data-icon="arrow-l" data-iconpos="notext">Personal Profile</a>
    <h1>Tastify</h1>
  </div>

  <div class="panel left" data-role="panel" data-position="left" data-display="reveal" id="panel-01">  
    <ul>
      <li><a href="" data-icon="plus">Favorites</a></li>
      <li><a href="" data-icon="plus">History</a></li>
      <li><a href="#account" data-rel="dialog" data-icon="plus">Account</a></li>
      <li><a href="logout.php" data-icon="star" action="logout.php">Log Out</a></li>
      <li><a href="" data-icon="alert">Report A Problem</a></li>
    </ul> 
  </div> 

  <div data-role="content">
    <?php
      $mysqli = new mysqli("localhost", "root","","Tastify");
      if ($mysqli == false) {
        die("Error: Could not connect. " . mysql_connect_error());
      }

      if($_SESSION['username'] != null) {
        $username = $_SESSION['username'];

        $sql = "select * from user_db where email = '$username'";
        if ($result = $mysqli->query($sql)) {
          if ($result->num_rows > 0) {
            while($row = $result->fetch_array()) {
              echo $row[0] . " " . $row[1] . " "  . $row[3] . " "  . $row[4] . "<br>";
              $userid= $row[0];
              $fname = $row[5];
            }
            $result->close();
          } else {
            echo "No reords matching your query were found.";
          }
        } else {
          echo "Error: could not execute $sql. " . $mysqli->error;
        }
      } else {
        echo "<h1>Please Log In First</h1>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
      }
    ?>   
  </div>

  <div data-role="footer" data-position="fixed">
    <div data-role="navbar">
      <ul>
        <li> <a href="#surprise" data-role="button" data-icon="star"> Surprise Me !</a> </li>
        <li> <a href="#menu-hot" data-role="button" data-icon="info"> Check the Menu</a> </li>
      </ul>
    </div>  
  </div>
</div> 


<! -- Surprise Tab -- >
<div data-role="page" id="surprise">
  <div data-role="header">
    <a href="#index" data-role="button" data-icon="home" data-iconpos="notext">Back to Index</a>
    <h1>Try this, <?php echo $fname ?> ;)</h1>
    <a href="#menu-hot" data-role="button" data-icon="info" >Check the Menu</a>
  </div>

  <div data-role="content">
    <ul data-role="listview">
    <?php
      require './OpenSlopeOne.php';
      $slopeone = new OpenSlopeOne();
    $slopeone->initSlopeOneTable('MySQL');

    $sql = "select s.item_id2 from slope_one s,rating_db u 
          where u.user_id = '$userid' 
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

<! -- Menu Tab HOT -- >
<div data-role="page" id="menu-hot">
  <div data-role="header">
    <a href="#index" data-role="button" data-icon="home" data-iconpos="notext">Back to Index</a>
    <h1>Varsity Top 10</h1>
    <a href="#surprise" data-role="button" data-icon="star" >Surpise Me!</a>
  </div>

  <div data-role="content">
    <ol data-role="listview">
    <?php
      $sql = "select item_id, count(item_id) as cnt
              from rating_db 
              group by item_id
              order by cnt desc
              limit 10";
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
        <li> <a href="" class="ui-btn-active ui-state-persist"> Top 10</a> </li>
        <li> <a href="#menu-full"> Menu</a> </li>
      </ul>
    </div>  
  </div>

</div> 

<! -- Menu Tab FULL -- >
<div data-role="page" id="menu-full">
  <div data-role="header">
    <a href="#index" data-role="button" data-icon="home" data-iconpos="notext">Back to Index</a>
    <h1>82 Dishes in Total</h1>
    <a href="#surprise" data-role="button" data-icon="star" >Surpise Me!</a>
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
        <li> <a href="#menu-hot"> Top 10</a> </li>
        <li> <a href="" class="ui-btn-active ui-state-persist"f> Menu</a> </li>
      </ul>
    </div>  
  </div>
</div>
  
  <! -- Account Tab -- >
<div data-role="page" id="account">
  <div data-role="header">
    <h1>Account Setting</h1>
  </div>

  <div data-role="content">
    <a href="update.php" data-rel="dialog" data-role="button">Change Password</a>
  </div>

</div> 



</div> 
</body>
</html>
