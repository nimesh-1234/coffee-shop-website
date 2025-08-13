<?php
	include 'components/connection.php'; 
	session_start();

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	} else {
		$user_id = '';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
		exit();
}

?>


<style type="text/css">
	<?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous">
	
	<title>Coffee - order Page </title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>order</h1>
		</div>
		<div class="title2">
			<a href="home.php">home</a><span>  /   order</span>
		</div>
		<section class="orders">
        	<div class="title">
        		<img src="img/download.png" class="logo">
        		<h1>my orders</h1>
        		<p>Review your selected items below before paying. Please make sure all sizes and product selections are correct. Once you are ready, fill in your billing details and place your order.</p>
        	</div>
        	<div class="box-container">
        		<?php 
        			$select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
        			$select_orders->execute([$user_id]);
        			if ($select_orders->rowCount() > 0) {
        				while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
        					$select_product = $conn->prepare("SELECT * FROM products WHERE id = ?");
							$select_product->execute([$fetch_order['product_id']]);
							if ($select_product->rowCount() > 0) {
							    $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
							 {
        		
        		?>
        		<div class="box" <?php if($fetch_order['status'] == 'cancel'){echo 'style="border:2px solid red";';} ?>>
        			<a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
        				<p class="date"><i class="fa-solid fa-calendar-days"></i><span><?=$fetch_order['date']; ?></span></p>
        				<img src="img/<?= $fetch_product['image']; ?>" class="image">
        				<div class="row">
        					<h3 class="name"><?= $fetch_product['name']; ?></h3>
        					<p class="price">Price : SLR <?= $fetch_order['price']; ?> X <?= $fetch_order['qty']; ?>/=</p>

        					<?php
							    $status_color = 'orange';
							    if ($fetch_order['status'] == 'delivered') {
							        $status_color = 'green';
							    } elseif ($fetch_order['status'] == 'cancled') {
							        $status_color = 'red';
							    }
							?>
						<p class="status" style="color:<?= $status_color ?>;"><?= ucfirst($fetch_order['status']); ?></p>

        				</div>
        			</a>
        		</div>
        		<?php
        			        	}
        					}
        				}
        			}else{
        				echo '<p class="empty">No orders have been placed yet!</p>';
        			}
        		?>
        	</div>
        	<?php include 'components/footer.php'; ?>
		</div> 

		</section>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
		<script src="script.js"></script>
		<?php include 'components/arlet.php'; ?>
</body>
</html>