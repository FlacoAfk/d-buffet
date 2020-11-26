<?php 	
		$mysqli = new mysqli('localhost', 'root', '', 'dbuffet');
		if ($mysqli->connect_errno): 
		echo '<script>alert("Error al conectarse con MySQL debido al error '.$mysqli->connect_error.'"); location="../index.php"</script>';
		endif;
 ?>