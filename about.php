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
	
	<title>Coffee - About Us Page </title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main"> 
		<div class="banner">
			<h1>about us</h1>
		</div>
		<div class="title2">
			<a href="home.php">home</a><span>  /   about</span>
		</div>
		<div class="about-category">
			<div class="box">
				<img src="img/coorg-arabica.png">
				<div class="detail">
					<span>Coffee</span>
					<h1>coorg-arabica</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="img/dark-roast(1).jpg">
				<div class="detail">
					<span>coffee</span>
					<h1>dark-roast</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="img/Robusta.png">
				<div class="detail">
					<span>coffee</span>
					<h1>robusta</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="img/Liberica.webp">
				<div class="detail">
					<span>coffee</span>
					<h1>liberica</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</div>

		<section class="services">
			<div class="title">
				<img src="img/download.png" class="logo">
				<h1>why choose us</h1>
				<p>From farm to cup, we ensure freshness, flavor, and ethical sourcing in every step of our coffee journey.</p>
			</div>
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
		<div class="about">
			<div class="row">
				<div class="img-box">
					<img src="img/3.png">
				</div>
				<div class="detail">
					<h1>visit our beautiful showroom</h1>
					<p>Our showroom is an expression of what we love doing; being creative with floral and plant arrangements. Whether you are looking for a florist for your perfect wedding; or just want to uplift any room with some of a kind living decor, Blossom with love can help.</p>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</div>
		<div class="testimonial-container">
			<div class="title">
				<img src="img/download.png" class="logo">
				<h1>What People Say About Us</h1>
				<p>We are committed to providing the highest quality coffee with fast delivery and friendly customer service across Sri Lanka.</p>

			</div>
				<div class="container">
					<div class="testimonial-item active">
						<img src="img/01.jpg">
						<h1>Sara Smith</h1>
						<p>"I was amazed by the rich flavor and smooth texture of their coffee. Delivery was quick and the customer service was outstanding. Highly recommend for any coffee lover in Sri Lanka!"</p>
					</div>
					<div class="testimonial-item">
						<img src="img/02.jpg">
						<h1>Jhon Smith</h1>
						<p>"Their coffee truly stands out! Each cup is fresh and full of flavor. I love how quickly it arrives at my doorstep, and their customer service is always so helpful. Definitely my go-to coffee shop in Sri Lanka!"</p>
					</div>
					<div class="testimonial-item">
						<img src="img/03.jpg">
						<h1>Selena Ansari</h1>
						<p>"As a coffee enthusiast, I’ve tried many brands, but none compare to the quality and taste of this coffee. It’s rich, smooth, and perfect for my mornings. Plus, the fast delivery is a big plus!"</p>
					</div>
					<div class="left-arrow" onclick="nextSlide()"><i class="fa-solid fa-circle-left"></i></div>
					<div class="right-arrow" onclick="prevSlide()"><i class="fa-solid fa-circle-right"></i></div>


				</div>
			</div>
		
		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<script>
	document.addEventListener("DOMContentLoaded", function () {
		let slides = document.querySelectorAll('.testimonial-item'); 
		let index = 0;

		function nextSlide(){
			slides[index].classList.remove('active');
			index = (index + 1) % slides.length;
			slides[index].classList.add('active');
		}

		function prevSlide(){
			slides[index].classList.remove('active');
			index = (index - 1 + slides.length) % slides.length;
			slides[index].classList.add('active');
		}

		document.querySelector(".left-arrow").addEventListener("click", prevSlide);
		document.querySelector(".right-arrow").addEventListener("click", nextSlide);
	});
</script>

	<?php include 'components/arlet.php'; ?>
</body>
</html>
