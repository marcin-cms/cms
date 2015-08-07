<?php

include('../init.php');
include('models/m_add-product.php');

$addProduct = new addProduct();
$SK->Auth->checkAuthorization();



 if(isset($_POST['submit'])){
 	
		$SK->Template->setData('title_product',$_POST['title_product']);
		$SK->Template->setData('description',$_POST['description']);
		$SK->Template->setData('price',$_POST['price']);
        
        if($_POST['title_product'] == '' || $_POST['description'] == '' || $_POST['price'] == ''){
            $SK->Template->setAlert('Wypełnij wymagane pola','error');
            $SK->Template->load(APP_PATH.'add-product/views/v_add-product.php');
        } else if ($_POST['title_product'] == $_POST['description']) {
                $SK->Template->setAlert('Nazwa produktu musi się różnić od opisu','error');
            	$SK->Template->load(APP_PATH.'add-product/views/v_add-product.php');
        } else {
        	$add = $addProduct->addProductDatabase($SK->Template->getData('title_product'),$SK->Template->getData('description'),$SK->Template->getData('price'));
        }
		if($add == TRUE){
			$SK->Template->setData('title_product','');
			$SK->Template->setData('description','');
			$SK->Template->setData('price','');
			$SK->Template->setAlert('Produkt został dodany','success');
			$SK->Template->load(APP_PATH.'add-product/views/v_add-product.php');
		} else {
			$SK->Template->setData('title_product','');
			$SK->Template->setData('description','');
			$SK->Template->setData('price','');
			$SK->Template->setAlert('Wystąpił błąd','error');
			$SK->Template->load(APP_PATH.'add-product/views/v_add-product.php');
		}
            
            
        
        
    } else {
        $SK->Template->load(APP_PATH.'add-product/views/v_add-product.php');
    }

?>