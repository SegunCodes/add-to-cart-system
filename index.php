<?php

//start session

session_start();


require_once 'createDB.php';
require_once 'component.php';


//create instance of createdb class
$database = new CreateDb("shegz","product");

if (isset($_POST['add'])) {
	//print_r($_POST['product_id']);
	if (isset($_SESSION['cart'])) {
		$item_array_id = array_column($_SESSION['cart'], 'product_id');
		
		if (in_array($_POST['product_id'], $item_array_id)) {
			echo "<script>alert('Product is already added to the cart')</script>";
			echo "<script>window.location='index.php'</script>";
		}else{
			$count= count($_SESSION['cart']);
			$item_array= array(
			'product_id'=>$_POST['product_id']
			);

			$_SESSION['cart'][$count]= $item_array;
		}

	}else{
		$item_array= array(
			'product_id'=>$_POST['product_id']
			);
		//create new session variable
		$_SESSION['cart'][0]= $item_array;
		print_r($_SESSION['cart']);
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
	<title>SHEGZ SHOPPING CART</title>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- <script type="text/javascript" rel="stylesheet" src="main.js"></script> -->
</head>
	<body>

	<?php require_once'header.php';?>
	<div class="container">
		<div class="row text-center py-5">
			<?php 
				$result=$database->getData();
				while ($row=mysqli_fetch_assoc($result)) {
					component($row['product_name'],$row['product_price'],$row['product_img'],$row['id']);
				}
			?>
		</div>
	</div>


	</body>
</html>