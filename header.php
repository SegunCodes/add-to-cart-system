<header id="header">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a href="index.php" class="navbar-brand">
			<h3 class="px-5">SM-Tech shopping cart </h3>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#shegzz" aria-controls="shegzz" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="shegzz">
			<div class="mr-auto"></div>
			<div class="navbar-nav">
				<a href="cart.php" class="nav-item nav-link active">
					<h5 class="px-5 cart">Cart <img src="img/cart.png" width="20px" height="10px">
					<?php
						if (isset($_SESSION['cart'])) {
							$count= count($_SESSION['cart']);
							echo '<span id="cart_count" class="bg-light text-warning">'.$count.'</span></h5>';
						}else{
							echo'<span id="cart_count" class="bg-light text-warning">0</span></h5>';
						}
					?>
				</a>
			</div>
		</div>
	</nav>
</header>
