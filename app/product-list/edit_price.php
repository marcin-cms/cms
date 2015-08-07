<?php
include("../init.php");

$SK->Auth->checkAuthorization();

if(isset($_POST['field'])){
	
	$id = $SK->Product_list_price->clean_block_id($_POST['id']);
	$type = htmlentities($_POST['type'], ENT_QUOTES);
	$content = $_POST['field'];
	
	$SK->Product_list_price->update_block($id,$content);
	
	$SK->Template->load(APP_PATH."product-list/views/v_saving.php");
	
} else {
	if(isset($_GET['id']) == FALSE || isset($_GET['type']) == FALSE){
		$SK->Template->error();
		exit;
	}
	
	$id = $SK->Product_list_price->clean_block_id($_GET['id']);
	$type = htmlentities($_GET['type'], ENT_QUOTES);
	
	$content = $SK->Product_list_price->load_block($id);
	$SK->Template->setData('block_id',$id);
	$SK->Template->setData('block_type',$type);
	$SK->Template->setData('cms_field',$SK->Product_list_price->generate_field($type,$content), false);
	
	$SK->Template->load(APP_PATH . 'product-list/views/v_edit_price.php');
	
}

?>