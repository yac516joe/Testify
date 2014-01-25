<?php

require './OpenSlopeOne.php';
$openslopeone = new OpenSlopeOne();

// $openslopeone->initSlopeOneTable();
$openslopeone->initSlopeOneTable('MySQL');


//var_dump($openslopeone->getRecommendedItemsById(63));

var_dump($openslopeone->getRecommendedItemsById(9));

//print_r($openslopeone->getRecommendedItemsByUser(3));

?>
