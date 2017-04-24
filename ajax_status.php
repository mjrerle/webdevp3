<?php
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");

echo json_encode(array('status'=>'open'));
?>
