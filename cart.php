<?php
require_once "templates/page_setup.php";
$page_name = "cart";
include "templates/header.php";
include "templates/jumbotron.php";
?>

<?php
function total (){
	$total = 0.0;
	$row = $_SESSION['array'];

	foreach ($row as $ing){
		$total += $_SESSION['items'][$ing->name]['Total'];
	}

	return $total;
}
?>

<?php
function view_cart(){
	$row = $_SESSION['array'];
	echo '<table class="table">';
	echo '<tr>
            <th>Name</th>
            <th>Price</th>
			<th>Quantity</th>
			<th>Site</th>
          </tr> ';
	foreach ($row as $ing){
		$price = number_format((float)$_SESSION['items'][$ing->name]['Total'], 2 , '.' , ''); // formatted to 2 decimals
    $quant = $_SESSION['items'][$ing->name]['Quantity']; //quantity
			echo '<tr>';
			echo "<td>$ing->name</td>";
			echo "<td>$price</td>";
			echo "<td>$quant</td>";
			echo "<td><a href=".$ing->teamURL.">$ing->teamURL</a></td>";
			echo "<td><a href=\"cart.php?remove=yes&name=$ing->name&cost=$ing->cost&team=$ing->teamURL\">Remove from Cart</a></td>";
			echo '</tr>';

	}
	echo '</table>';
}
function remove_item($name){
	foreach($_SESSION['array'] as $itemsKey => $items){
		foreach($items as $valueKey => $value){
			if($valueKey == 'name' && $value == $name){
				//delete this particular object from the $array
				unset($_SESSION['array'][$itemsKey]);
			}
		}
	}
	if (empty($_SESSION['array']))
		unset($_SESSION['array']);
}
?>

<?php
if (isset($_GET['remove'])):
  $name = strip_tags($_GET['name']);
  $cost = strip_tags($_GET['cost']);
  $team = strip_tags($_GET['team']);
  $sing = new cart($name,$cost,$team);
	$quant = $_SESSION['items'][$name]['Quantity'];
	if ($quant <= 1):
		unset($_SESSION['items'][$name]); //remove
		remove_item($name);//unset($_SESSION['array']);
		unset($_GET['name']);
	else:
		$_SESSION['items'][$name]['Quantity']--; //remove only 1
		$_SESSION['items'][$name]['Total'] -= $sing->cost;
	endif;
	header('Location: cart.php');
	die();
endif;
?>

<?php
if (!isset($_SESSION['array']) and !isset($_GET['name'])):
	echo '<h3 align="center">Your Cart is Empty</h3>';
	echo '<p align="center"><a href="food.php">Continue Shopping</a></p>';
	require 'templates/footer.php';
	die();
endif;
?>

<?php
class cart{
  public $name;
  public $cost;
  public $teamURL;
  public function __construct($name="",$cost=0,$teamURL=""){
    $this->name=$name;
    $this->cost=$cost;
    $this->teamURL=$teamURL;
  }
}
?>

<?php
if (isset($_GET['name'])):
	$name = strip_tags($_GET['name']);
  $team = strip_tags($_GET['team']);
  $cost = doubleval($_GET['cost']);
  $sing = new cart($name,$cost,$team);
	if (!isset($_SESSION['array'])):
		$row = array(); //stores ingredients in cart
		$row[] = $sing;
		$_SESSION['array'] = $row;
		$_SESSION['items'] = array();
		$_SESSION['items'][$name] = array('Quantity' => 1, 'Total' => $row[0]->cost);
	else:
		$row = $_SESSION['array'];
		if (isset($_SESSION['items'][$name])): //item exists already
			$_SESSION['items'][$name]['Quantity']++;
			$price = $sing->cost;
			$_SESSION['items'][$name]['Total'] += $price;
		else:
			//create a new item
			$_SESSION['items'][$name] = array('Quantity' => 1, 'Total' => $sing->cost);
			$row[] = $sing; //add to cart
			$_SESSION['array'] = $row;
		endif;
	endif;
endif;
?>

<div class="cart">
	<h2 align="center">My Cart</h2>
	<?php view_cart(); ?>
	<h3 align="center">Your Total is: $<?php echo number_format((float)total(), 2 , '.' , '');?></h3>
	<p align="center"><a href="checkout.php">Checkout</a></p>
	<p align="center"><a href="products.php">Continue Shopping</a></p>
</div>

<?php require 'templates/footer.php';?>
