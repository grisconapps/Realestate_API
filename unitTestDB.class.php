<?php
include_once('./RealEstateDB.class.php');
$query = "select * from property where propId='Hateen4111';";
$db = new RealEstateDB('root','password','realestate');
$db->connect();

$result = $db->prepareQuery($query);
print "$result\n";
$db->close();
?>
