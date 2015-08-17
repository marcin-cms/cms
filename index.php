<?php include("app/init.php");
session_start();
?>


<!DOCTYPE  html>
<html>
<head>
	<title>Sklep internetowy - Marcin Witek</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="app/res/css/sk_style.css" />
	<?php $SK->head(); ?>	
</head>
<body>
	<?php $SK->toolbar(); ?>	
	<div id="wrapper">
		<div class="head-left">
			<h1>Sklep internetowy - 'Arsenal'</h1>
		</div>
		
		<div class="head-right"><?php $SK->login_link(); ?></div>
		
		<div class="clear"></div>
		
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<li><a href='#'>Start</a></li>
					<li><a href='#'>Koszulki</a></li>
					<li><a href='#'>Piłki</a></li>
					<li><a href='#'>Kontakt</a></li>
				</ul>
			</div>
		</div>
		
		<div class="content row">
			
			<div class="span9" id="left-c">
			
				<?php if($result = $SK->Database->query("SELECT * FROM products ORDER BY id DESC")): 
					if($result->num_rows > 0):?>
				<?php while($row = $result->fetch_object()): ?>
				<form method="post" action="app/cart/cart.php">
					
					<h2><?php $SK->Product_list_title->display_block($row->id,'oneline'); ?></h2>
				<hr />
				<div class="well">
					 
					<?php $SK->Product_list_description->display_block($row->id,'oneline'); ?>
					<label>Cena: <?php $SK->Product_list_price->display_block($row->id,'oneline'); ?>zł netto</label>
					
					<label>
  						<label for="ex1">Ilość</label>
  						<input type="text" size="2" maxlength="2" name="product_quantity" class="quantity_product" value="1" />
					</label>
					
					<input type="hidden" name="product_id" value="<?php echo $row->id ?>" />
					<input type="hidden" name="type" value="add" />
					<input type="Submit" class="btn btn-succes" value="Dodaj Do koszyka" />
			</form>
			</div>
			<?php endwhile; ?>
			<?php endif;endif; ?>
			</div>
				
		
			
			<div class="span3" id="right-c">
				<div class="well right-content">
				
				<?php 
				$SK->cart_box();
					if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0){
					$SK->cart_link();
					echo '<br /><br /><a href="app/cart/cart_clean.php">Wyczyść koszyk</a>';
					}
				 ?>
			
						
				</div>
				<div class="well right-content">
					
				</div>
				<div>
					<img src="<?php SITE_PATH ?>app/res/images/right_cms.png" alt="" /> 
				</div>
			</div>
		</div>
		<div id="footer">
			&copy; 2015 Marcin Witek
		</div>
	</div>		
	
</body>
</html>