<?php 
	$direccion = $_SERVER['REQUEST_URI'];
	$findme   = 'deprimerafutbol';
	$redireccion = strpos($direccion, $findme);
	if ($dire === true) {
		header("location: 'wwww.deprimerafutbol.com/trofeos'");
		exit(0);
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    html {
        height:100%;
        width:100%;
    }
    body{
        background:#8ba987 url('img/proximamente.jpg') no-repeat center center;
        background-size:100% 100%;
    }
    </style>
</head>
<body>
</body>
</html>