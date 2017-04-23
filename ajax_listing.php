<?php
include "templates/page_setup.php";
require_once "create.php";
if(!$dbh=setupProductConnection()) die;
dropTableByName("ingredient");
dropTableByName("comment");
dropTableByName("images");
createTableIngredient();
createTableImage();
createTableComment();
$db = new Database();
loadProductsIntoEmptyDatabase();
$ingredients = $db->getIngredients();
$count = $db->getNumberOfIngredients();
$array = array();
$i=0;
while($i<$count){
  $array[$i] = array("name"=>$ingredients[$i]->name, "short"=>$ingredients[$i]->description, "unit"=>$ingredients[$i]->unit,"cost"=>$ingredients[$i]->price);
  $i++;
}

echo json_encode($array);
?>
