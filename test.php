<?php 
					/*$select_products = $conn->prepare("SELECT * FROM products");
					$select_products->execute();
					if ($select_products->rowCount() > 0) {
						while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
							
				?>

				<?php 
					/*}
				}else{
					echo '<p class="empty">no products added yet!</p>';
				}*/
				?>
				<h3 class="name"><?=$fetch_products['name']; ?></h3>
				<p class="price">price $<?=$fetch_products['price']; ?>/=</p>