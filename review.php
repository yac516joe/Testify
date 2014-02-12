<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Review Your Order</title> 
<link rel="stylesheet" href="./css/jquery.mobile-1.3.1.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
<script type="text/javascript" src="rating_lib/jquery.raty.min.js"></script>
</head>

<body>
  <! -- Orders Tab -- >
  <div data-role="page" id="review">
    <div data-role="header">
      <a href="member.php" data-role="button" data-icon="arrow-l">Back</a>
      <h1>How do you like it?</h1>      
    </div>

    <div data-role="content">
      <div data-role='navbar' data-iconpos="left">   
        <li><a data-icon="info">Come back after finish your dishes to review them!</a></li>
      </div>
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

          if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
              $i = 0;
              echo "<ul data-role='listview' data-inset='true' >";
              while($row = $result->fetch_array()) {
                echo "<li><a><h2>" .$row[2] . "</h2>
                    <div id='star-".$i."'></div></a></li>";
                $i ++;
              }     
              echo "<li><p>Your rating will help us learn your taste more accurately</p></li>";     
              echo "</ul>";    
              echo "</div><div data-role='footer' data-position='fixed'> <div data-role='navbar' data-iconpos='left'> <ul><li>";
              echo "<a href='review.php' data-role='button' data-icon='arrow-r' data-transition='pop'>Next</a>" ;
              echo "</li></ul></div>";
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
    </div>
  </div>
</body>
</html>


<script type="text/javascript">
  $(function() {
    $.fn.raty.defaults.path = 'rating_lib/img';
    <?php
      $k = 0;
      while ($k < $i) {
        echo "$('#star-" . $k . "').raty({ score: 3});";
        $k ++;
      }
    ?>
    $('#^=star').raty({ score: 3});
  }) ();
</script>