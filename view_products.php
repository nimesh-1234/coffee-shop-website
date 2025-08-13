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

// adding products in wishlist
if (isset($_POST['add_to_wishlist'])) {
	$id = unique_id();
	$product_id = $_POST['product_id'];

	$verify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
	$verify_wishlist->execute([$user_id, $product_id]);

	$cart_num = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
	$cart_num->execute([$user_id, $product_id]);

	if ($verify_wishlist->rowCount() > 0) {
		$warning_msg[] = 'product already exists in your wishlist';
	} else if ($cart_num->rowCount() > 0) {
		$warning_msg[] = 'product already exists in your cart';
	} else {
		$select_price = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
		$select_price->execute([$product_id]);
		$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

		$insert_wishlist = $conn->prepare("INSERT INTO wishlist (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
		$insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);

		$success_msg[] = 'product added to wishlist successfully';
	}
}

// adding products in cart

if (isset($_POST['add_to_cart'])) {
	$id = unique_id();
	$product_id = $_POST['product_id'];

	$qty = $_POST['qty'];
	$qty = filter_var($qty, FILTER_SANITIZE_STRING);

	$verify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
	$verify_cart->execute([$user_id, $product_id]);

	$max_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
	$max_cart_items->execute([$user_id]);

	if ($verify_cart->rowCount() > 0) {
		$warning_msg[] = 'product already exists in your cart';
	} else if ($max_cart_items->rowCount() > 20) {
		$warning_msg[] = 'cart is full';
	} else {
		$select_price = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
		$select_price->execute([$product_id]);
		$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

		$insert_cart = $conn->prepare("INSERT INTO cart (id, user_id, product_id, price,qty) VALUES (?, ?, ?, ?, ?)");
		$insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);

		$success_msg[] = 'product added to cart successfully';
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
	
	<title>Coffee - Shop Page </title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>Shop</h1>
		</div>
		<div class="title2">
			<a href="home.php">home</a><span>  /   shop</span>
		</div>
		<section class="products">
    	<div class="box-container">
        <?php 
            $select_products = $conn->prepare("SELECT * FROM products");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                $counter = 0; 
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;
 
                    /*if ($counter == 1) {
                        echo '<h2 class="section-title">Hot Coffee</h2>';
                    }

                    if ($counter == 6) {
                        echo '<h2 class="section-title">Premium Teas</h2>';
                    }*/
        ?>
				<form action="" method="post" class="box">
					<img src="img/<?=$fetch_products['image']; ?>" class="img">
					<div class="button">
						<button type="submit" name="add_to_cart"><i class="fa-solid fa-cart-shopping"></i></button>
						<button type="submit" name="add_to_wishlist"><i class="fa-solid fa-heart"></i></button>
						<a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fa-solid fa-eye"></a>
					</div>
					<h3 class="name"><?=$fetch_products['name']; ?></h3>
					<input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">
					<div class="flex">
						<p class="price">Price : SLR <?=$fetch_products['price']; ?>/=</p>
						<input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
					</div>
					<a href="checkout.php?get_id=<?=$fetch_products['id']; ?>" class="btn">buy now</a>
					
				</form>
				<?php 
					}
				}else{
					echo '<p class="empty">no products added yet!</p>';
				}
				?>
			</div> 
		</section>

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/arlet.php'; ?>
</body>
</html>