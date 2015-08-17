<?php
	
include("../init.php");
// remove all session variables
session_unset();

$SK->Template->redirect(SITE_PATH);

?>