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
		
		/* obiekt cms */
		
		include(APP_PATH . "cms/models/m_cms.php");
		$this->Cms = new Cms();
		
		  
		 
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
	}
	
	function toolbar(){
		if($this->Auth->checkLoginStatus() == TRUE){
			include(APP_PATH . "core/templates/t_toolbar.php");
		}
	}
	function login_link(){
		if($this->Auth->checkLoginStatus() == TRUE){
			echo "<a href='". SITE_PATH . "app/logout.php' class='btn btn-success btn-large'>Wyloguj</a>";
		} else {
			echo "<a href='?login' class='btn btn-success btn-large'>Zaloguj</a>";
		}
	}
}

?>