<!DOCTYPE html>
<html>
<head>
	<title>MW Login</title>
	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="views/style.css">	
</head>
<body>
	<h1>Użytkownicy</h1>
	
	
		<?php
			$alerts = $this->getAlerts();
			if($alerts != ''){
				echo '<ul class="alerts">'. $alerts . '</ul>';
			}
		?>
		
		<a href="logout.php">Wyloguj</a>
</body>
</html>