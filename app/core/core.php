<?php

class SK_Core{
	
	public $Template, $Auth, $Database;
	
	function SK_Core($serwer,$user,$password,$db){
		$this->Database = new mysqli($serwer,$user,$password,$db);
		
		
		/* obiekt template */
		
		include(APP_PATH . "core/models/m_template.php");
		$this->Template = new Template();
		$this->Template->setAlertTypes(array('success','warning','error'));
		
		/* obiekt autoryzacji */
		
		include(APP_PATH . "core/models/m_auth.php");
		$this->Auth = new Auth();
		
		/* obiekty produtk-list */
		
		include(APP_PATH . "product-list/models/m_product_list_title.php");
		$this->Product_list_title = new Product_list_title();
		include(APP_PATH . "product-list/models/m_product_list_description.php");
		$this->Product_list_description = new Product_list_description();
		include(APP_PATH . "product-list/models/m_product_list_price.php");
		$this->Product_list_price = new Product_list_price();
		 
		 /*  start sesji */
		
		session_start();
		
		
	}
	
	function __destruct(){
		$this->Database->close();
		
	}
	
	function head(){
		if($this->Auth->checkLoginStatus() == TRUE){
			include(APP_PATH . "core/templates/t_head.php");
		}
		if(isset($_GET['login']) && $this->Auth->checkLoginStatus() == FALSE) {
			include(APP_PATH . "core/templates/t_login.php");
		}
		if(isset($_GET['cart'])) {
			include(APP_PATH . "core/templates/t_cart.php");
			
		}  
		
	}
	
	function toolbar(){
		if($this->Auth->checkLoginStatus() == TRUE){
			include(APP_PATH . "core/templates/t_toolbar.php");
		}
	}
	function product_list(){
		include(APP_PATH . "core/templates/t_product-list.php");
	}
	function login_link(){
		if($this->Auth->checkLoginStatus() == TRUE){
			echo "<a href='". SITE_PATH . "app/logout.php' class='btn btn-success btn-large'>Wyloguj</a>";
		} else {
			echo "<a href='?login' class='btn btn-success btn-large'>Zaloguj</a>";
		}
	}
	function cart_box(){
		include(APP_PATH . "cart/views/v_cart_box.php");
	}
	function cart_link(){
		echo "<a href='?cart' class='button_koszyk btn btn-success'>Pokaż Koszyk</a>";
		
	}
}

?>