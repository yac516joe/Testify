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
      <a href="#panel-01" data-role="button" data-icon="info" data-iconpos="notext">Personal Profile</a>
      <h1>Tastify</h1>
    </div>

    <div class="panel left" data-role="panel" data-position="left" data-display="reveal" id="panel-01">  
      <ul>
        <li><a href=""  data-icon="star">About Me</a></li>
        <li><a href=""  data-icon="alert">Report A Problem</a></li>
      </ul>
    </div>  

    <div data-role="content">
      <?php
        $mysqli = new mysqli("localhost", "root","","Tastify");
          if ($mysqli == false) {
            die("Error: Could not connect. " . mysql_connect_error());
          } 
      ?>   
    </div>

    <div data-role="footer" data-position="fixed">
      <div data-role="navbar">
        <ul>
          <li><a href="register.php" data-role="button">Sign Up</a></li>
          <li><a href="login.php" data-role="button">Log In</a></li>
        </ul>
      </div>  
    </div>
  </div> 
</body>
</html>
