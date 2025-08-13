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

	if (isset($_GET['get_id'])) {
		$get_id = $_GET['get_id'];
	}else{
		$get_id = '';
		header("location: order.php");
		exit();
	}

	if (isset($_POST['cancle'])) {
		$update_order = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
		$update_order->execute(['cancled', $get_id]);
		header("location: order.php");
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
	
	<title>Coffee - order details Page </title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>order details</h1>
		</div>
		<div class="title2">
			<a href="home.php">home</a><span>  /   order details</span>
		</div>
		<section class="order-detail">
        	<div class="title">
        		<img src="img/download.png" class="logo">
        		<h1>order details</h1>
        		<p>Review your selected items below before paying. Please make sure all sizes and product selections are correct. Once you are ready, fill in your billing details and place your order.</p>
        	</div>
        	<div class="box-container">
        		<?php
        			$grand_total = 0;
        			$select_orders = $conn->prepare("SELECT * FROM orders WHERE id = ? LIMIT 1");
        			$select_orders->execute([$get_id]);
        			if ($select_orders->rowCount() > 0) {
        				while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
        					$select_product = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
        					$select_product->execute([$fetch_order['product_id']]);
        					if ($select_product->rowCount() > 0) {
        						while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
        							$sub_total = ($fetch_order['price'] * $fetch_order['qty']);
        							$grand_total += $sub_total;

        		?>
        		<div class="box">
        			<div class="col">
        				<p class="title"><i class="fa-solid fa-calendar-days"></i><?= $fetch_order['date']; ?></p>
        				<img src="img/<?= $fetch_product['image']; ?>" class="image">
        				<p class="price"><?= $fetch_product['price']; ?> X <?= $fetch_order['qty']; ?></p>
        				<h3 class="name"><?= $fetch_product['name']; ?></h3>
        				<p class="grand_total">Total Amount Payable : <span>SLR <?= $grand_total; ?>/=</span></p>
        			</div>
        			<div class="col">
        				<p class="title">billing address</p>
        				<p class="user"><i class="fa-solid fa-user"></i><?= $fetch_order['name']; ?></p>
        				<p class="user"><i class="fa-solid fa-mobile-screen-button"></i><?= $fetch_order['number']; ?></p>
        				<p class="user"><i class="fa-solid fa-envelope"></i><?= $fetch_order['email']; ?></p>
        				<p class="user"><i class="fa-solid fa-location-dot"></i><?= $fetch_order['address']; ?></p>
        				<p class="title">status</p>
        				<p class="status" style="color:<?php if ($fetch_order['status'] == 'delivered') {echo "green";}elseif ($fetch_order['status'] == 'cancled') {echo "red";}else{echo "orenge";}?>"><?= $fetch_order['status'] ?></p>
        				<?php if ($fetch_order['status'] == 'cancled') { ?>
        					<a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a>
        				<?php }else{ ?>
        					<form method="post">
        						<button type="submit" name="cancle" class="btn" onclick="return confirm('do you want to cancel this order')">cencel order</button>
        					</form>
        				<?php } ?>
        			</div>
        		</div>
        		<?php 
        			        	}
        					}else{
        						echo '<p class="empty">product not found!</p>';
        					}
        				}
        			}else{
        				echo '<p class="empty">No order not found!</p>';
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