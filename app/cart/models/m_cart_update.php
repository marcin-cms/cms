<?php
class Cart {
	
	function Cart(){
		global $SK;
	}
	function cutWord($tresc,$ile){
   $licz = strlen($tresc);
		if ($licz>=$ile)
   		 {
        	$tnij = substr($tresc,0,$ile);
       		$txt = $tnij."...";
    	} else {
        		$txt = $tresc;
		}
   			return $txt;
		}
}
	


?>