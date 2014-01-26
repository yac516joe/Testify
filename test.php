<?php

require './OpenSlopeOne.php';
$openslopeone = new OpenSlopeOne();

// $openslopeone->initSlopeOneTable();
$openslopeone->initSlopeOneTable('MySQL');


//var_dump($openslopeone->getRecommendedItemsById2(63));

$row = $openslopeone->getRecommendedItemsById2(55);
echo $row[2];

//print_r($openslopeone->getRecommendedItemsByUser(3));

?>
