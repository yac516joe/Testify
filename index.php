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
    <a href="#reg" data-role="button" data-icon="info" data-iconpos="notext">Personal Profile</a>
    <h1>Tastify</h1>
    <a href="" data-role="button" data-icon="gear" data-iconpos="notext">Setting</a>
  </div>

  <div data-role="content">
    <a href="register.php">Register</a>
     <?php
      $mysqli = new mysqli("localhost", "root","","Tastify");
        if ($mysqli == false) {
          die("Error: Could not connect. " . mysql_connect_error());
        } else {
          echo "<br>" . "Connection Success" . "<br>";
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
    <a href="#index" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>Recommendation based on your preference</h1>
    <a href="#menu-hot" data-role="button" data-icon="info" >Check the Menu</a>
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

<! -- Menu Tab HOT -- >
<div data-role="page" id="menu-hot">
  <div data-role="header">
    <a href="#index" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>Hottest Items</h1>
    <a href="#surprise" data-role="button" data-icon="star" >Surpise Me!</a>
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

<! -- Menu Tab FULL -- >
<div data-role="page" id="menu-full">
  <div data-role="header">
    <a href="#index" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
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
        <li> <a href="#menu-hot"> Hottest</a> </li>
        <li> <a href="" class="ui-btn-active ui-state-persist"f> Menu</a> </li>
      </ul>
    </div>  
  </div>
  
</div> 
</body>
</html>
