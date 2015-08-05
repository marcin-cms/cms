<?php

include('../init.php');
include('models/m_settings.php');

$settings = new Settings();

$SK->Auth->checkAuthorization();

if(isset($_POST['submit'])){

	$SK->Template->setData('oldpass',$_POST['oldpass']);
	$SK->Template->setData('newpass',$_POST['newpass']);
	$SK->Template->setData('newpass2',$_POST['newpass2']);
	
	/* walidacja */
	if($_POST['oldpass'] == '' || $_POST['newpass'] == '' || $_POST['newpass2'] == ''){
		$SK->Template->setAlert('Wypełnij wymagane pola','error');
		$SK->Template->load(APP_PATH.'settings/views/v_password.php');
	} else if ($_POST['newpass'] != $_POST['newpass2']){
		$SK->Template->setAlert('Wartość w polach hasła musi być identyczna','error');
		$SK->Template->load(APP_PATH.'settings/views/v_password.php');
	} else if ($SK->Auth->validateLogin($SK->Auth->getCurrentUserName(),$SK->Template->getData('oldpass')) == FALSE){
		$SK->Template->setAlert('Stare hasło jest nie prawidłowe','error');
		$SK->Template->load(APP_PATH.'settings/views/v_password.php');
	} else if ($SK->Template->getData('oldpass') == $_POST['newpass'] ){
		$SK->Template->setAlert('Nowe hasło jest identyczne jak stare hasło','error');
		$SK->Template->load(APP_PATH.'settings/views/v_password.php');
	} else {
		$changed = $settings->changePassword($SK->Auth->getCurrentUserName(),$SK->Template->getData('newpass'));
		
		if($changed == TRUE){
			$SK->Template->setData('oldpass','');
			$SK->Template->setData('newpass','');
			$SK->Template->setData('newpass2','');
			$SK->Template->setAlert('Hasło zostało zmienione','success');
			$SK->Template->load(APP_PATH.'settings/views/v_password.php');
		} else {
			$SK->Template->setData('oldpass','');
			$SK->Template->setData('newpass','');
			$SK->Template->setData('newpass2','');
			$SK->Template->setAlert('Wystąpił błąd','error');
			$SK->Template->load(APP_PATH.'settings/views/v_password.php');
		}
	}
	
	
} else {
	$SK->Template->load(APP_PATH.'settings/views/v_password.php');
}


?>