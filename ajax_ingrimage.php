<?php

include "templates/page_setup.php";
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");
if(isset($_GET['ing'])){
  $db = new Database();
  $ing = strip_tags($_GET['ing']);
  $ingredient = $db->getIngredientbyName($ing);
  $path = (dirname(__FILE__)) ."/assets/img/". $ingredient['imgURL'];
  $type = pathinfo($path, PATHINFO_EXTENSION);
  $data = file_get_contents($path);
  echo json_encode(base64_encode($data));
}
else
  header('location: index.php');

?>
