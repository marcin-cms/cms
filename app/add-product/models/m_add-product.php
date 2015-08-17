<?php

class addProduct {
		
	function addProductDatabase($title_product,$description,$price){
		
		global $SK;
		
		if($stmt = $SK->Database->prepare("INSERT products (title_product,description,price) VALUES (?,?,?)")){
			$stmt->bind_param('sss',$title_product, $description,$price);
			$stmt->execute();
			$stmt->close();
			
			return TRUE;
		} else {
			return FALSE;
		}
	}
}


?>