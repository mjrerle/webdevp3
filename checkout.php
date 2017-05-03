<?php
require_once "templates/page_setup.php";
$page_name = "checkout";
include "templates/header.php";
include "templates/jumbotron.php";
?>

<?php

	if (isset($_POST['check'])){
		$users = User::readUsers(); //get users from users.csv
		foreach ($users as $u){
			if ($u->status == 'Admin'){
        $to = $u->email;
        $t=0;
        if(!empty($_GET['total'])) $t = doubleval($_GET['total']);
				$subject = 'CT310 Empo Team -- Customer Purchase: $'.number_format((float)$t,2,'.','').' has been billed to your account.';
				$message = 'This is an email from www.cs.colostate.edu/~mjrerle/p3/ and is not an actual bill. This is for testing purposes only.';
				mail($to,$subject,$message);
			}
		}
		clear_cart();
		//header('Location: cart.php');
		echo '<h2 align="center">Thanks for Shopping With Us!</h2>';
		echo '<p align="center"><a href="food.php">Back To Shopping</a></p>';
		include 'templates/footer.php';
		die();
	}

	function clear_cart(){
		unset($_SESSION['array']);
		unset($_SESSION['items']);
  }
  $total;
  $str = '<h1 align="center">Your Total is $0.00</h1>
	<h2 align="center">Are You Sure You Want To Checkout?</h2>
	<form action="#" method="post">
		<input type="submit" name="check" value="Checkout">
	</form>
</div>';
  if(!empty($_GET['total'])){
   $total = doubleval($_GET['total']);
$str = '<div class="checkout">
	<h1 align="center">Your Total is $'. number_format((float)$total, 2 , '.' , '').'</h1>
	<h2 align="center">Are You Sure You Want To Checkout?</h2>
	<form action="#" method="post">
		<input type="submit" name="check" value="Checkout">
	</form>
</div>';
    echo $str;
  }
  else{
    echo $str;
  }
?>

<?php require 'templates/footer.php';?>
