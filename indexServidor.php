<?php 
	$direccion = $_SERVER['HTTP_HOST'];
	$findme   = 'deprimerafutbol';
	$redireccion = strpos($direccion, $findme);
	if ($redireccion !== false) {
		header("location: /trofeos");
		exit(0);
	} else {
		header("location: /lavecchia");
		exit(0);
	}
?>
