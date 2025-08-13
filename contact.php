<?php
	include 'components/connection.php'; 
	session_start();
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
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
	
	<title>Coffee - Home Page </title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>contact us</h1>
		</div>
		<div class="title2">
			<a href="home.php">home</a><span>  /   contact us</span>
		</div>
		<section class="services">
			<div class="box-container">
				<div class="box">
					<img src="img/icon2.png">
					<div class="detail">
						<h3>great savings</h3>
						<p>save big every order</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon1.png">
					<div class="detail">
						<h3>24*7 support</h3>
						<p>one-on-one support</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon0.png">
					<div class="detail">
						<h3>gift vouchers</h3>
						<p>vouchers on every festivals</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon.png">
					<div class="detail">
						<h3>islandwide delivary</h3>
						<p>dropship islandwide</p>
					</div>
				</div>
			</div>
		</section>
		<div class="form-container">
			<form method="post">
				<div class="title">
					<img src="img/download.png" class="logo">
					<h1>leave a massage</h1>
				</div>
				<div class="input-field">
					<p>your name<sup>*</sup></p>
					<input type="text" name="name">
				</div>
				<div class="input-field">
					<p>your email <sup>*</sup></p>
					<input type="email" name="email">
				</div>
				<div class="input-field">
					<p>your number <sup>*</sup></p>
					<input type="text" name="number">
				</div>
				<div class="input-field">
					<p>your massage<sup>*</sup></p>
					<textarea name="massage"></textarea>
				</div>
				<button type="submit" name="submit-btn" class="btn">send massage</button>
			</form>
		</div>
		<div class="address">
				<div class="title">
					<img src="img/download.png" class="logo">
					<h1>contact details</h1>
					<p>From farm to cup, we ensure freshness, flavor, and ethical sourcing in every step of our coffee journey.</p>
				</div>
				<div class="box-container">
					<div class="box">
						<i class="fa-solid fa-location-dot"></i>
						<div>
							<h4>address</h4>
							<p>No 63, East Drive Lane, Colombo 02</p>
						</div>
					</div>
					<div class="box">
						<i class="fa-solid fa-phone"></i>
						<div>
							<h4>phone number</h4>
							<p>041 22 55 743</p>
						</div>
					</div>
					<div class="box">
						<i class="fa-solid fa-envelope"></i>
						<div>
							<h4>email</h4>
							<p>CaffeineCascade23@gmail.com</p>
						</div>
					</div>
				</div>
			</div>
	<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/arlet.php'; ?>
</body>
</html>