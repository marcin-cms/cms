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
		<h2>Panel Ustawień</h2>
		<p> Wybierz opcje z lewej kolumny</p>	
	</div>
	
</div>

<?php
	
	$this->load(APP_PATH.'core/templates/t_page_foot.php');	

?>