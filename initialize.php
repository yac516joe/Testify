<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tastify</title> 
<link rel="stylesheet" href="./css/jquery.mobile-1.3.1.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>
  <! -- Initialize Tab 1 -- >
  <div data-role="page" id="tab1">
    <div data-role="header">
      <a href="index.php" data-role="button" >Exit</a>
      <h1>Cuisines</h1>
    </div>

    <div data-role="content">
      <?php
        $mysqli = new mysqli("localhost", "root","","Tastify");
        if ($mysqli == false) {
          die("Error: Could not connect. " . mysql_connect_error());
        } 

        $userid = $_SESSION['$userid'];
        $product_id = $_GET['id']; //the product id from the URL 
        $action = $_GET['action']; //the action from the URL 


      ?>
      <form  method="POST" action="initialize.php" id="registerForm">
            <fieldset data-role="controlgroup">
              <legend>Tap to select your favorite food</legend>
                  <label for="vegi">A vegi</label>
                  <input type="checkbox" name="vegi" id="vegi" value="1">
                  <label for="diet">On Diet</label>
                  <input type="checkbox" name="diet" id="diet" value="1">
                  <label for="spice">Spicy Food Lover</label>
                  <input type="checkbox" name="spice" id="spice" value="1"> 
            </fieldset>
        <input type="submit" name="submit" value="Next">
      </form>


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
