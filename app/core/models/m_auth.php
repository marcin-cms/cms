<?php

class Auth {
	
	private $salt = 'e3FGDe4';
	
	function Auth(){
		
	}
	
	function validateLogin($user,$pass){
		global $SK;
		
		if($stmt = $SK->Database->prepare("SELECT * FROM users WHERE username = ? AND password = ?")){
			$pass = md5($pass.$this->salt);	
			$stmt->bind_param("ss", $user, $pass);
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows > 0){
				$stmt->close();
				return TRUE;
			} else {
				$stmt->close();
				return FALSE;
			}
		}else {
			die();
		}
		
	}
	
	function checkLoginStatus(){
		if(isset($_SESSION['loggedin'])){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function checkAuthorization(){
		global $SK;
		if($this->checkLoginStatus() == FALSE){
			$SK->Template->error('unathorized');
			exit;
		}
	}
	function getCurrentUserName(){
		return $_SESSION['username'];
	}
	function getSalt(){
		return $this->salt;
	}
	
	function logout(){
		session_destroy();
		session_start();
	}
}

?>