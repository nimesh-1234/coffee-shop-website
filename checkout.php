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

	if (isset($_POST['place_order'])) {
		$name = $_POST['name'];
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$number = $_POST['number'];
		$number = filter_var($number, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['pincode'];
		$address = filter_var($address, FILTER_SANITIZE_STRING);
		$address_type = $_POST['address_type'];
		$address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
		$method = $_POST['method'];
		$method = filter_var($method, FILTER_SANITIZE_STRING);
		$contact_type = $_POST['contact_type'];
		$contact_type = filter_var($contact_type, FILTER_SANITIZE_STRING);
		
		$varify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
		$varify_cart->execute([$user_id]);

		if (isset($_GET['get_id'])) {
			$get_product = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
			$get_product->execute([$_GET['get_id']]);
			if ($get_product->rowCount() > 0) {
				while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
					$insert_order = $conn->prepare("INSERT INTO orders (id, user_id, name, number, email, address, address_type, method, contact_type, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
					$insert_order->execute([unique_id(),$user_id, $name, $number, $email, $address, $address_type, $method, $contact_type, $fetch_p['id'], $fetch_p['price'],1]);
					header('location: order.php');

				}
			}else{
				$warning_msg[] = 'somthing went warong!';
			}

		}elseif ($varify_cart->rowCount() > 0) {
			while ($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)) {
			    $get_product = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
			    $get_product->execute([$f_cart['product_id']]);
			    $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);

			    if ($fetch_p) {
			        $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, name, number, email, address, address_type, method, contact_type, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

			        $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $contact_type, $fetch_p['id'], $fetch_p['price'], $f_cart['qty']]);
			    }
			}

	        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
	        $delete_cart_id->execute([$user_id]);

	        header('location: order.php');
	        exit();
    
		}else{
				$warning_msg[] = 'somthing went warong!';
			}

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
	
	<title>Coffee - checkout Page </title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>checkout summary</h1>
		</div>
		<div class="title2">
			<a href="home.php">home</a><span>  /   checkout summary</span>
		</div>
		<section class="checkout">
    		<div class="title">
    			<img src="img/download.png" class="logo">
    			<h1>checkout summary</h1>
    			<p>Review your selected items below before paying. Please make sure all sizes and product selections are correct. <br> Once you are ready, fill in your billing details and place your order.</p>
    		</div>
    			<div class="row">
    				<form method="post">
    					<h3>billing details</h3>
    					<div class="flex">
    						<div class="box">
    							<div class="input-field">
    								<p>your name <span>*</span></p>
    								<input type="text" name="name" required maxlength="50" placeholder="Enter Your Name" class="input">
    							</div>
    							<div class="input-field">
    								<p>your number <span>*</span></p>
    								<input type="number" name="number" required maxlength="10" placeholder="Enter Your Number" class="input">
    							</div>
    							<div class="input-field">
    								<p>your email <span>*</span></p>
    								<input type="email" name="email" required maxlength="50" placeholder="Enter Your Email" class="input">
    							</div>
    							<div class="input-field">
    								<p>payment method <span>*</span></p>
    								<select name="method" class="input">
    									<option value="cash on delivary">cash on delivary</option>
    									<option value="credit or debit card">credit or debit card</option>
    									<option value="net banking">net banking</option>
    									<option value="PickMePay or eZ Cash">PickMePay or eZ Cash</option>
    									<option value="Visa">Visa</option>
    								</select>
    							</div>
    							<div class="input-field">
    								<p>address type <span>*</span></p>
    								<select name="address_type" class="input">
    									<option value="home">home</option>
    									<option value="workplace">work place</option>
    								</select>
    							</div>
    						</div>
    						<div class="box">
    							 <div class="input-field">
    								<p>address line 01 <span>*</span></p>
    								<input type="text" name="flat" required maxlength="50" placeholder="e.g. flat or building number" class="input">
    							</div>
    							<div class="input-field">
    								<p>address line 02 <span>*</span></p>
    								<input type="text" name="street" required maxlength="50" placeholder="e.g. street name" class="input">
    							</div>
    							<div class="input-field">
    								<p>city name <span>*</span></p>
    								<input type="text" name="city" required maxlength="50" placeholder="Enter Your City Name" class="input">
    							</div>
    							<div class="input-field">
									  <p>Contact Preference <span>*</span></p>
									  <select name="contact_type" class="input">
									    <option value="">Select</option>
									    <option value="call">Phone Call</option>
									    <option value="sms">SMS</option>
									    <option value="email">Email</option>
									  </select>
								</div>
    							<div class="input-field">
    								<p>pincode <span>*</span></p>
    								<input type="text" name="pincode" required maxlength="50" placeholder="110033" min="0" max="999999" class="input">
    							</div>
    						</div>
    					</div>
    					<button type="submit" name="place_order" class="btn">place order</button>
    				</form>
    				<div class="summary">
    					<h3>my bag</h3>
    					<div class="box-container">
    						<?php 
    							$grand_total = 0;
									if (isset($_GET['get_id'])) {
									    $select_get = $conn->prepare("SELECT * FROM products WHERE id = ?");
									    $select_get->execute([$_GET['get_id']]);
									    while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
									        $sub_total = (int)$fetch_get['price']; 
									        $grand_total += $sub_total;

    						?>
    						<div class="flex">
    							<img src="img/<?=$fetch_get['image']; ?>" class="image">
    							<div>
    								<h3 class="name"><?=$fetch_get['name']; ?></h3>
    								<p class="price">SLR <?=$fetch_get['price']; ?>/=</p>
    							</div>
    						</div>
    						<?php 
    								}
    							}else{
    								$select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    								$select_cart->execute([$user_id]);
    								if ($select_cart->rowCount()>0) {
    									while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
    										$select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
    										$select_products->execute([$fetch_cart['product_id']]);
    										$fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
    										$sub_total = (int)$fetch_cart['qty'] * (int)$fetch_product['price'];
											$grand_total += $sub_total;

    							
    						?>
    						<div class="item-box">
								<img src="img/<?=$fetch_product['image']; ?>" alt="">
								<div class="details">
									<h3 class="name"><?=$fetch_product['name']; ?></h3>
									<p class="price"><?=$fetch_product['price']; ?> X <?=$fetch_cart['qty']; ?>/=</p>
								</div>
							</div>

    						<?php 
    									}
    								}else{
    									echo '<p class="empty">your cart is empty!</p>';
    								}
    							}
    						?>
    					</div>
    					<div class="grand_total"><span>total amount payable : </span>SLR <?=$grand_total ?>/=</div>
    				</div>
    		</div>
		</section>

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/arlet.php'; ?>
</body>
</html>