<?php
require_once "templates/page_setup.php";
include "templates/header.php";
if (isset($_GET['ing'])){ //&& $_GET['team'])
    $db = new Database();
    $ing = trim($_GET['ing'],'"');
    $team = trim($_GET['team'],'"');
    $page_name = $ing;
    $title = $ing;
}
else{
header('location: index.php');
}
include 'templates/jumbotron.php';
?>
<script type="text/javascript" src="food_page.js"></script>

<div class = "container-fluid product-details" id ="product_details">

  <div class="row">

    <div class="col-md-3" id = "productImgCol">

      <img id = "product-image" src = "" alt="product_image" style="">
    </div>
    <div class = "col-md-3" id="productDetailsCol">
<?php

?>
      <h3 class="name"><?php echo $ing?></h3>
      <h3 class="debug"></h3>
      <!--<h3 id="masterstatus"></h3>-->

      <p class="desc">Ingredient description</p>
      <?php //echo $dbh->getRatingStars($dbh->averageRating($ingredient));?>
      <span class =""><a href="#reviewList"><?php// echo $reviewCount;?> Reviews</a></span>

 <?php if (isset($_SESSION['username']) and $_SESSION['username']!="Guest"): //adds a cart option if user is signed in ?>
	  <h4 id = "cart"></h4>
	  <?php endif;?>
      $<span class="price"></span> per <span class = "unit"></span>
    </div>
    <div class = "col-md-3" id=productPurchaseCol>
    </div>
  </div>
  <hr>
    <div class = "row">
      <div class = "col-sm-6" id="reviewList" style="margin-left:20px;">
<?php
?>
            </div>
          </div>
        </div>
      <?php require 'templates/footer.php';?>


