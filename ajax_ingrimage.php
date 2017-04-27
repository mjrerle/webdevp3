<?php
<<<<<<< HEAD

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

=======
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
>>>>>>> 4b906efe875bdf895d310e2d022995ff2a106a84
?>
