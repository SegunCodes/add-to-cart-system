<?php


session_start();
require_once 'createDB.php';
require_once 'component.php';

//create instance of createdb class
$db = new CreateDb("shegz","product");
if (isset($_POST['remove'])) {
	if ($_GET['action']=='remove') {
		foreach ($_SESSION['cart'] as $key => $value) {
			if ($value["product_id"]==$_GET['id']) {
				unset($_SESSION['cart'][$key]);
				echo "<script>alert('Product has been removed!')</script>";
				echo "<script>window.location='cart.php'</script>";
			}
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
	<title>Cart</title>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-light">

<?php require_once'header.php';?>
<br>
<div class="container-fluid">
	<div class="row px-5">
		<div class="col-md-7">
			<div class="shopping-cart">
				<h6>My Cart</h6>
				<hr>

				<?php
					$total = 0;
					if (isset($_SESSION['cart'])) {
						$product_id= array_column($_SESSION['cart'],'product_id');
						$result=$db->getData();
						while ($row=mysqli_fetch_assoc($result)) {
							foreach ($product_id as $id) {
								if ($row['id']==$id) {
									cartElement($row['product_img'],$row['product_name'],$row['product_price'],$row['id']);
									$total= $total + (int)$row['product_price'];
								}
							}
						}
					}
					else{
						echo "<h5>You don't have have any item added in your cart</h5>";
					}
				?>
			</div>
		</div>
		<div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
			<div class="pt-4">
				<h6>PRICE DETAILS</h6>
				<hr>
				<div class="row price-details">
					<div class="col-md-6">
						<?php

							if (isset($_SESSION['cart'])) {
								$count = count($_SESSION['cart']);
								echo "<h6>Price($count items)</h6>";
							}else{
								echo "<h6>Price(0 items)</h6>";								
							}
						?>
						<h6>Delivery Charges</h6>
						<hr>
						<h6>Amount Payable</h6>
					</div>
					<div class="col-md-6">
						<h6>$<?php echo $total;?></h6>
						<h6 class="text-success">FREE</h6>
						<hr>
						<h6>$<?php echo $total;?></h6>
						<?php
						if (isset($_SESSION['cart'])):
						if (count($_SESSION['cart'])>0):
						?>
						<a href="#" class="btn btn-info mb-2 ml-0">Checkout</a>
						<?php endif; endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>