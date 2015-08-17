<?php 

include('../init.php');
include('models/m_cart_update.php');

session_start();
$Cart = new Cart();


if(isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_quantity"]>0){
	
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product['return_url']); 
	
 	//we need to get product name and price from database.
    $statement = $SK->Database->prepare("SELECT title_product, price FROM products WHERE id=? LIMIT 1");
    $statement->bind_param('s', $new_product['product_id']);
    $statement->execute();
    $statement->bind_result($product_name, $price);
	while($statement->fetch()){
		
		//fetch product name, price from db and add to new_product array
        $new_product["product_name_cart"] = $product_name;
        $new_product["product_name"] = $Cart->cutWord($product_name,'24');
		$new_product["product_price"] = $price;
        
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['product_id']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['product_id']]); //unset old array item
            }           
        }
     	
        $_SESSION["cart_products"][$new_product['product_id']] = $new_product; //update or create product session with new item  
    	
	} 
}


//update or remove items 
if(isset($_POST["product_quantity"]) || isset($_POST["remove_code"]))
{
	
	//update item quantity in product session
	if(isset($_POST["product_quantity"]) && is_array($_POST["product_quantity"])){	
		foreach($_POST["product_qunatity"] as $key => $value){
			if(is_numeric($value)){
				$_SESSION["cart_products"][$key]["product_quantity"] = $value;
			}
		}
	}
	//remove an item from product session
	if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
			
		foreach($_POST["remove_code"] as $key){
			unset($_SESSION["cart_products"][$key]);
		}
	}
}

//back to return url

header('Location: http://marcinwitek.com/cms');


?>