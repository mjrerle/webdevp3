<?php
include "templates/page_setup.php";
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");
if (isset($_GET['ing'])){
 $db = new Database();
 $ing = trim($_GET['ing'],'"');
 $ingredient = $db->getIngredientbyName($ing);//get initial ingredient
 $img = $ingredient['imgURL'];//get the img url ex sugar.png
 $imgArray = $db->getImageByName($img);//get the image info from the images table via the imgURL
 echo json_encode($imgArray);
 }
?>
