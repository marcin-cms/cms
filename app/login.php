<?php

include("init.php");


if(isset($_POST['username'])){
	
	$SK->Template->setData('input_user',$_POST['username']);
	$SK->Template->setData('input_pass',$_POST['password']);
	
	if($_POST['username'] == '' || $_POST['password'] == ''){
		$SK->Template->setAlert('Uzupełnij wymagane pola','error');
		echo '<script>$.colorbox.resize();</script>';
		$SK->Template->load(APP_PATH . "core/views/v_login.php");
	} else if ($SK->Auth->validateLogin($SK->Template->getData('input_user'),$SK->Template->getData('input_pass')) == FALSE){
		$SK->Template->setAlert('Nieprawidłowy login lub hasło','error');
		echo '<script>$.colorbox.resize();</script>';
		$SK->Template->load(APP_PATH . "core/views/v_login.php");
	} else {
		$_SESSION['username'] = $SK->Template->getData('input_user');
		$_SESSION['loggedin'] = TRUE;
		$SK->Template->load(APP_PATH . "core/views/v_loggingin.php");
	}
} else {
	$SK->Template->load(APP_PATH . "core/views/v_login.php");
}


?>