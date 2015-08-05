<?php 

include('../init.php');

$SK->Auth->checkAuthorization();

$SK->Template->load(APP_PATH . 'panel/views/v_panel.php');

?>
