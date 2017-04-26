<<<<<<< HEAD
=======
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
>>>>>>> 56fb0888ef3c07ac515cba6686f05547dda96096
