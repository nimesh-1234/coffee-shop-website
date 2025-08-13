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
		<section class="home-section">
			<div class="slider">
			<div class="slider__slider slide1">
				<div class="overlay"></div>
				<div class="slide-detail">
					<h1>Brewed fresh. Served warm. Loved always.</h1>
					<p>“At our coffee shop, every cup is brewed with care — rich flavor and a warm welcome in every sip.”</p>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="hero-dec-top"></div>
				<div class="hero-dec-bottom"></div>
			</div>
			<!-- slide end -->
			<div class="slider__slider slide2">
				<div class="overlay"></div>
				<div class="slide-detail">
					<h1>Brewed fresh. Served warm. Loved always.</h1>
					<p>“At our coffee shop, every cup is brewed with care — rich flavor and a warm welcome in every sip.”</p>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="hero-dec-top"></div>
				<div class="hero-dec-bottom"></div>
			</div>
			<!-- slide end -->
			<div class="slider__slider slide3">
				<div class="overlay"></div>
				<div class="slide-detail">
					<h1>Brewed fresh. Served warm. Loved always.</h1>
					<p>“At our coffee shop, every cup is brewed with care — rich flavor and a warm welcome in every sip.”</p>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="hero-dec-top"></div>
				<div class="hero-dec-bottom"></div>
			</div>
			<!-- slide end -->
			<div class="slider__slider slide4">
				<div class="overlay"></div>
				<div class="slide-detail">
					<h1>Brewed fresh. Served warm. Loved always.</h1>
					<p>“At our coffee shop, every cup is brewed with care — rich flavor and a warm welcome in every sip.”</p>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="hero-dec-top"></div>
				<div class="hero-dec-bottom"></div>
			</div>
			<!-- slide end -->
			<div class="slider__slider slide5">
				<div class="overlay"></div>
				<div class="slide-detail">
					<h1>Brewed fresh. Served warm. Loved always.</h1>
					<p>“At our coffee shop, every cup is brewed with care — rich flavor and a warm welcome in every sip.”</p>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="hero-dec-top"></div>
				<div class="hero-dec-bottom"></div>
			</div>
			<!-- slide end -->
		</div>
		</section>
		<!-- home slider end -->

		<section class="thumb">
			<div class="box-container">
				<div class="box">
					<img src="img/thumb2.jpg">
					<h3>Classic Brew</h3>
					<p>Our signature hot coffee, freshly brewed to energize your day.</p>
					<i class="fa-solid fa-circle-chevron-right"></i>
				</div>
				<div class="box">
					<img src="img/thumb0.jpg">
					<h3>Iced Coffee Bliss</h3>
					<p>Chilled, smooth, and perfect for sunny days or cool cravings.</p>
					<i class="fa-solid fa-circle-chevron-right"></i>
				</div>
				<div class="box">
					<img src="img/thumb1.jpg">
					<h3>Coffee & Croissant</h3>
					<p>A buttery croissant paired with a bold brew - the perfect combo.</p>
					<i class="fa-solid fa-circle-chevron-right"></i>
				</div>
				<div class="box">
					<img src="img/thumb.jpg">
					<h3>Green Bean Coffee</h3>
					<p>Unroasted coffee beans packed with antioxidants and wellness.</p>
					<i class="fa-solid fa-circle-chevron-right"></i>
				</div>
			</div>
		</section>
		<section class="container">
			<div class="box-container">
				<div class="box">
					<img src="img/about-us.jpg">
				</div>
				<div class="box">
					<img src="img/download.png">
					<span>Caffeine Cascade</span>
					<h1>Savor the Art of Crafted Brews – Where Every Sip Tells a Story."</h1>
					<p>“We believe great coffee brings people together — that’s why every cup we serve is brewed with care, rich in flavor, and full of heart.”</p>
				</div>
			</div>
		</section>
		<section class="shop">
			<div class="title">
			    <img src="img/download.png">
			    <h1>Welcome <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest!'; ?></h1>
			</div>
			<div class="row">
				<img src="img/about.jpg">
				<div class="row-detail">
					<img src="img/basil.jpg">
					<div class="top-footer">
						<h1>a cup of coffee maks you healthy</h1>
					</div>
				</div>
			</div>
			<div class="box-container">
				<div class="box">
					<img src="img/hot-coffee.png">
					<a href="view_products.php" class="btn">hot-coffee</a>
				</div>
				<div class="box">
					<img src="img/cold-coffee.png">
					<a href="view_products.php" class="btn">cold-coffee</a>
				</div>
				<div class="box">
					<img src="img/hot-tea.png">
					<a href="view_products.php" class="btn">hot-tea</a>
				</div>
				<div class="box">
					<img src="img/cold-tea.png">
					<a href="view_products.php" class="btn">cold-tea</a>
				</div>
				<div class="box">
					<img src="img/refreshers.png">
					<a href="view_products.php" class="btn">refreshers</a>
				</div>
				<div class="box">
					<img src="img/hot-chocolate.png">
					<a href="view_products.php" class="btn">hot-chocolate/lemonade</a>
				</div>
			</div>
		</section>
		<section class="shop-category">
			<div class="box-container">
				<div class="box">
					<img src="img/6.jpg">
					<div class="detail">
						<span>BIG OFFERS</span>
						<h1>Extra 15% off</h1>
						<a href="view_products.php" class="btn">shop now</a>
						</div>
					</div>
					<div class="box">
					<img src="img/7.jpg">
					<div class="detail">
						<span>new in taste</span>
						<h1>coffee house</h1>
						<a href="view_products.php" class="btn">shop now</a>
						</div>
					</div>
				</div>
		</section>
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
		<section class="brand">
			<div class="box-container">
				<div class="box">
					<img src="img/brand (1).jpg">
				</div>
				<div class="box">
					<img src="img/brand (2).jpg">
				</div>
				<div class="box">
					<img src="img/brand (3).jpg">
				</div>
				<div class="box">
					<img src="img/brand (4).jpg">
				</div>
				<div class="box">
					<img src="img/brand (5).jpg">
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