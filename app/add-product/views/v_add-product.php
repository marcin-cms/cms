<?php
	$this->load(APP_PATH.'core/templates/t_page_head.php');
	
?>

<div class="panel_wrapper">
	
	<h1>Ustawienia</h1>
	<a href="#" id="sk_cancel" class="btn btn-succes b-close">Zamknij</a>
	
	<div class="sk-panel-left">
		<ul class="nav nav-tabs nav-stacked nav-color">
			<li><a href="<?php SITE_PATH ?>../panel/index.php">Start</a></li>
			<li><a href="<?php SITE_PATH ?>../settings/password.php">Zmień hasło</a></li>
			<li><a href="<?php SITE_PATH ?>../add-product/add-product.php">Dodaj produkt</a></li>
			<li><a href="<?php SITE_PATH ?>../panel/index.php">Opcje</a></li>
		</ul>	
	</div>
	<div class="sk-panel-right">
		<h2>Dodaj nowy Produkt</h2>
		<form action="#" method="post" id="edit">
			<div>
			<?php
			$alerts = $this->getAlerts();
			if($alerts != ''){
				echo '<ul class="alerts">'. $alerts . '</ul>';
			}
			?>
			</div>
			<label for="title_product">Nazwa produktu:*</label>
			<input type="text" name="title_product" id="title_product"  value="<?php echo $this->getData('title_product'); ?>"/>
			
			<label for="description">Opis produktu:*</label>
			<textarea name="description" id="description"  value="<?php echo $this->getData('description'); ?>"></textarea>
			
			<label for="price">Podaj cenę (netto):*</label>
			<input type="text" name="price" id="price"  value="<?php echo $this->getData('price'); ?>"/>
			
			<label><i>*Wymagane pola</i></label>
			<br/><br/>
			
			<input type="Submit" name="submit" class="btn btn-primary" value="Dodaj produkt" />
		
		</form>	
	</div>
	
</div>

<?php
	
	$this->load(APP_PATH.'core/templates/t_page_foot.php');	

?>