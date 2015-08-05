<?php

class Settings {
		
	function changePassword($user,$newpass){
		
		global $SK;
		
		if($stmt = $SK->Database->prepare("UPDATE users SET password = ? WHERE username = ?")){
			$newpass = md5($newpass.$SK->Auth->getSalt());
			$stmt->bind_param('ss',$newpass, $user);
			$stmt->execute();
			$stmt->close();
			
			return TRUE;
		} else {
			return FALSE;
		}
		
		
	}
}


?>