<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>

<! -- Index Tab -- >
<div data-role="page" id="index">
  <div data-role="header">
    <a href="" data-role="button" data-icon="info" data-iconpos="notext">Personal Profile</a>
    <h1>Tastify</h1>
    <a href="" data-role="button" data-icon="gear" data-iconpos="notext">Setting</a>
  </div>

  <div data-role="content">
    <a href=""> Index Page</a>
 
    <?php
      $mysqli = new mysqli("localhost", "root","","Tastify");
        if ($mysqli == false) {
          die("Error: Could not connect. " . mysql_connect_error());
        } else {
          echo "<br>" . "Connection Success" . "<br>";
        }
    ?>    
  </div>

  <div data-role="footer">
    <div data-role="navbar">
      <ul>
        <li> <a href="#surprise" data-role="button" data-icon="star"> Surprise Me !</a> </li>
        <li> <a href="#menu-hottest" data-role="button" data-icon="info"> Check the Menu</a> </li>
      </ul>
    </div>  
  </div>
</div> 

<! -- Menu Tab -- >
<div data-role="page" id="menu-hottest">
  <div data-role="header">
    <a href="index" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>82 Dishes in Total</h1>
    <a href="#surprise" data-role="button" data-icon="star" >Surpise Me!</a>
  </div>

  <div data-role="content">
  	<a href="#index" data-role="button">Hottest</a>    
  </div>

  <div data-role="footer">
    <div data-role="navbar">
      <ul>
        <li> <a href="" class="ui-btn-active"> Hottest</a> </li>
        <li> <a href="#menu-full"> Menu</a> </li>
      </ul>
    </div>  
  </div>

</div> 


<div data-role="page" id="menu-full">
  <div data-role="header">
    <a href="index" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>82 Dishes in Total</h1>
    <a href="#surprise" data-role="button" data-icon="star" >Surpise Me!</a>
  </div>

  <div data-role="content">
    <?php
  //Attempy query execution
  $sql = "select * from categories_db";
  if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
      while($row = $result->fetch_array()) {
        echo  "<div data-role='collapsible'><h4>" . $row[1] . "</h4></div>";
      }
      $result->close();
    } else {
      echo "No reords matching your query were found.";
    }
  } else {
    echo "Error: could not execute $sql. " . $mysqli->error;
  }

  //close connection
  $mysqli->close() ;
  ?>


  </div>

  <div data-role="footer">
    <div data-role="navbar">
      <ul>
        <li> <a href="#menu-hottest"> Hottest</a> </li>
        <li> <a href="" class="ui-btn-active"> Menu</a> </li>
      </ul>
    </div>  
  </div>

</div> 

<! -- Surprise Tab -- >
<div data-role="page" id="surprise">
  <div data-role="header">
    <a href="index" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back to Index</a>
    <h1>Tastify</h1>
    <a href="#menu-hottest" data-role="button" data-icon="info" >Check the Menu</a>
  </div>

  <div data-role="content">
    <a href="#index" data-role="button">index</a>    
  </div>

  <div data-role="footer">
    <div data-role="navbar">
      <ul>
        <li> <a href="#surprise"> Surprise Me</a> </li>
        <li> <a href="#menu-hottest"> Check the menu</a> </li>
      </ul>
    </div>  
  </div>

</div> 


</body>
</html>
