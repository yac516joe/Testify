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
        <li> <a href="./surprise.php" data-role="button" data-icon="star"> Surprise Me !</a> </li>
        <li> <a href="./menu.php" data-role="button" data-icon="info"> Check the Menu</a> </li>
      </ul>
    </div>  
  </div>
</div> 

</body>
</html>
