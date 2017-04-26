<?php
include "templates/page_setup.php";
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");
if (isset($_GET['ing'])){
 $db = new Database();
 $ing = trim($_GET['ing'],'"');
 $ingredient = $db->getIngredientbyName($ing);
 $ingarray = array("name"=>$ingredient['i_name'], "short"=>$ingredient['description'], "unit"=>$ingredient['unit'],"cost"=>$ingredient['price'],"time"=>$ingredient['time'], "desc"=>$ingredient['longdescription']); //redient['i_name']
 echo json_encode($ingarray);
 }
?>
