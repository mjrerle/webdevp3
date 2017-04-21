<?php
header ( 'Content-Type: text/json' );
header ( "Access-Control-Allow-Origin: *" );


$n = $_REQUEST ["a"];

switch ($n) {
	case "open" :
		$s = "green";
		break;
	case "closed" :
		$s = "red";
		break;
	default :
		$s = "yellow";
		break;
}

echo json_encode($s);
?>
