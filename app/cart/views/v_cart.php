<script>
$(document).ready(function(){
		
		$('#cart').submit(function(e){
			e.preventDefault();
			
		});
		
		
		$('#sk_cancel').live('click', function(e){
			e.preventDefault();
			
			$.colorbox.close();
			
			var page = window.location.href;
			page = page.substring(0,page.lastIndexOf('?'));
			window.location = page;
		});
		
	});
	
</script>
	
<div class="form-wrapper form-horizontal well">
	<form action="" method="post" id="cart">
		<div>
			<a href="#" id="sk_cancel" class="cancel btn btn-success">Zamknij</a>
			<h3>Koszyk</h3>
		</div>
		<div style="clear: both"></div>
		<p>*Cena netto jednostkowa</p>
		<table class="table"><thead><tr><th>ID</th><th>Nazwa produktu</th><th>Cena netto*</th><th>Ilość</th><th>Usuń</th><th>Cena za wszystko</th></tr></thead>
		</tbody>
		<?php
		session_start();
		if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0){
					$total =0;
					foreach ($_SESSION["cart_products"] as $cart_itm)
					{
						$product_name = $cart_itm["product_name_cart"];
						$product_qty = $cart_itm["product_quantity"];
						$product_price = $cart_itm["product_price"];
						$product_code = $cart_itm["product_id"];
						$subtotal = ($product_price * $product_qty);
						echo '<tr>';
						echo '<td>'.$product_code.'</td>  ';
						echo '<td>'.$product_name.'</td>';
						echo '<td>Cena: '.$product_price.'zł</td>  ';
						echo '<td><input type="text" class="quantity_product" value="'.$product_qty.'"/></td>';
						echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /></td>';
						echo '<td>Cena: '.$subtotal.'zł</td>';
						echo '</tr>';
						$total = ($total + $subtotal);
					}
				} else{
					echo 'Koszyk jest pusty';
				}
				
				$currency = 'zł'; // waluta
				$shipping_cost = 20; // koszt wysyłki
				$taxes = array( // Lista vat
                            'VAT' => 23,
                            ); 
				 $grand_total = $total + $shipping_cost; 
			       
			        foreach($taxes as $key => $value){ 
			                $tax_amount = round($total * ($value / 100));
			                $tax_item[$key] = $tax_amount;
			                $grand_total = $grand_total + $tax_amount;  
					}
				 $list_tax       = '';
			        foreach($tax_item as $key => $value){
			            $list_tax .= $key. ' : '.sprintf("%01.2f",$value).$currency.'<br />';
			        }
			        $shipping_cost = ($shipping_cost)?'Koszt wysyłki : ' .$shipping_cost.' '.$currency.'<br />':'';	
		
		?>
		<tr><td colspan="5"><span style="float:right;text-align: right;">Cena netto: <?php echo $total.' '.$currency.'</br>'; echo $shipping_cost. $list_tax; ?>Koszt ogólny : <?php echo sprintf("%01.2f", $grand_total).' '.$currency; ?></span></td></tr>
	</tbody>
	</table>
	
	<input type="submit" name="submit" class="submibtn btn-primary" value="Złóż zamówienie" /> 
	</form>
	</div>

</body>
</html>