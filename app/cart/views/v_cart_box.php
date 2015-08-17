<?php
	session_start();
	if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0){
				echo '<h3>Koszyk</h3>';	
				echo '<form method="post" action="app/cart/cart.php">';	
					$total =0;
					foreach ($_SESSION["cart_products"] as $cart_itm)
					{
						$product_name = $cart_itm["product_name"];
						$product_qty = $cart_itm["product_quantity"];
						$product_price = $cart_itm["product_price"];
						$product_code = $cart_itm["product_id"];
					?>
						
						<label><b><?php echo $product_name; ?></b> </label>
						<label>Ilość: <strong><?php echo $product_qty; ?></strong>  Cena:<strong><?php echo $product_price*$product_qty; ?>zł</strong><br/>
						
						<input type="checkbox" name="remove_code[]" value="<?php echo $product_code; ?>" /> Usuń<br/><br/>
					<?php $subtotal = ($product_price * $product_qty);
						  $total = ($total + $subtotal);
			
					}?>
					<label><strong><p style='font-size:20px;'>Suma: <?php echo $total; ?>zł</p></strong></label>
					<button type="submit" class="button_usun btn btn-small">Usuń wybrane produkty</button>
					</form>
				<?php
				
				} else{
					echo 'Koszyk jest pusty';
				}	
?>
	
		

	
	
	
