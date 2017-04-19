<?php
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");

$a= array();
$i =0;
$a[$i++] = array('status'=>'closed');
echo json_encode($a);
?>
