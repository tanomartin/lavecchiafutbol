<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	
	
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	
	// Casilla detino
	$casilla_destino = "info@gambetafemenina.com.ar";
	//$casilla_destino = "aialvarez@yahoo.com";
	$nombre = (isset($_POST["nombre"]))? $_POST["nombre"] : "";
	$email = (isset($_POST["email"]))? $_POST["email"] : "";
	$telefono = (isset($_POST["telefono"]))? $_POST["telefono"] : "";
	$mensaje = (isset($_POST["mensaje"]))? $_POST["mensaje"] : "";
	
	
	$asunto = "Consulta - Gambeta Femenina";
	$cuerpo_mail .= "Nombre y Apellido: ".$nombre."\r\n";
	$cuerpo_mail .= "Email: ".$email."\r\n";
	$cuerpo_mail .= "Telefono: ".$telefono."\r\n";
	$cuerpo_mail .= "Mensaje: ".$mensaje."\r\n";
	
	
	@mail($casilla_destino, $asunto, $cuerpo_mail);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: Gambeta Femenina ::</title>
<meta name="author" content="gambetafemenina.com">
<meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física">
<meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres">
<link rel="stylesheet" href="css/home.css" type="text/css">
<style type="text/css">
	<!--

	#wrap { margin:0 auto 0 auto; width:100%; height:100%  }
	
	#encabezado { margin:0 auto 0 auto; width:100%; height:242px;
			background-image:url(img/home/costados1.jpg);
			background-repeat:repeat-x;
   }

	#cabezal {
		background-image:url(img/home/cabezal.jpg);
		background-repeat:no-repeat;
		width:999px;
		height:242px;
		margin:0 auto 0 auto;
	}
	
	
	#quienes_somos {
		position: relative;
		left: 790px;
		top: 20px; /*442*/
		width: 170px;
		height: 25px;
		/*background-color:#F00*/
	}	
	
	#reglamento { 
		position: relative;
		left: 790px;
		top: 35px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00*/
	}	

	#sedes { 
		position: relative;
		left: 790px;
		top: 50px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00*/
	}	

	#contacto { 
		position: relative;
		left: 790px;
		top:  65px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00*/
	}	
	#menu { 
		position: relative;
		left: 50px; 
		top: 90px; /*442*/ 
		text-align:left;
	/*	background-color:#F00*/
	}	


	#cabezal1 {
		width:999px;
		height:275px;
		margin:0 auto 0 auto;
	}

	#imagen {
		background-image:url(img/contacto/contacto_2.jpg);
		background-repeat:no-repeat;
		width:767px;
		height:333px;
		margin:0 auto 0 auto;
	}


	#faceytweet {
		background-image:url(img/home/faceytweet.jpg);
		background-repeat:no-repeat;
		width:232px;
		height:275px;
		margin:0 auto 0 auto;
	}


	#campo_tiempo { 
		position: relative;
		left: 37px; 
		top:  25px; /*442*/ 
		width: 90px; 
		height: 90px;
		text-align:left;
	}	
	#facebook { 
		position: relative;
		left: 35px; 
		top: 80px; /*442*/ 
		width: 190px; 
		height: 90px;
		text-align:left;
	}

	#twitter { 
		position: relative;
		left: 110px; 
		top: -10px; /*442*/ 
		width: 190px; 
		height: 90px;
		text-align:left;
	}

	#fecha { 
		position: relative;
		left: 30px; 
		top: -280px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}


	#cabezal2 {
		width:900px;
		height:44px;
		margin:0 auto 0 auto;
	}

	#cabezal3 {
		width:999px;
		margin:0 auto 0 auto;
	}

	#descripcion { 
		position: relative;
		left: 50px; 
		top:  35px; /*442*/ 
		width: 500px; 
		_width: 430px; 		
		height: 90px;
		text-align:left;
	}
	

	#titulo_auspiciante {
		background-image:url(img/home/titulo_auspiciante.jpg);
		background-repeat:no-repeat;
		width:185px;
		height:44px;;
		margin:0px 0px 0px -9px;
		text-align:left;		
	}
	
	#auspiciantes {
		width:210px;
		margin:0px 0px 0px 18px;
		text-align:left;		
	}

	#auspiciantes1 {
		width:210px;
		margin:5px auto 0 20px;
		border-left: 2px solid #CCC;
		text-align:left;		
	}

	#gf{ 
		position: absolute;
		left:520px; 
		top: 0px; /*442*/ 
		width: 300px; 
		height: 200px;
		text-align:left;
	/*	background-color:#F00*/
	}


	#pie_repetir { margin:0 auto 0 auto; width:100%; height:44px;
			background-image:url(img/home/pie1.jpg);
			background-repeat:repeat-x;
   }

	#pie{
		background-image:url(img/home/pie.jpg);
		background-repeat:no-repeat;
		width:999px;
		height:44px;
		margin:0 auto 0 auto;
	}
-->
</style>
<script>
	function pagina(id){
		document.getElementById('id').value= id;		
		document.form_alta.action = "noticias.php";
		document.form_alta.submit();
	}
</script>
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'/>
</script>
<script type='text/javascript'> 
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	});    
</script>
</head>
<body align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
<form id="form_alta" name="form_alta" action="enviar_mail.php" method="post">
  <input name="id" id="id"  value="-1" type="hidden" />
  <input name="accion" id="accion"  value="registro" type="hidden" />
  <div id="wrap">
    <div id="encabezado">
      <div id="cabezal">
        <div id="quienes_somos"  style="cursor:pointer" onclick="window.location = 'quienes_somos.php';"></div>
        <div id="reglamento" style="cursor:pointer"  onclick="window.location = 'reglamento.php';"></div>
        <div id="sedes" style="cursor:pointer" onclick="window.location = 'sedes.php';"></div>
        <div id="contacto"  style="cursor:pointer" onclick="window.location = 'contacto.php';"></div>
	  </div>
	</div>
    <div id="cabezal1" style="margin-top:5px" align="center">
		 <? for ($i=0; $i<count( $aTorneos ); $i++) {  
				$oObj = new TorneoCat();
				$categoria = $oObj ->getByTorneo($aTorneos[$i][id]);?>
				<img src="logos/<?= $aTorneos[$i]['logoMenu'] ?>"  border="0" width="43px" height="54px" onclick="pagina('<?= $categoria[0][id]?>')" style="cursor: pointer"/>
		 <? } ?>
		 <div id="menu"></div> 
		 <div id="imagen" style="float:left"> </div>
		<div id="auspiciantes" style="float:left">     
			<div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
			<? include('auspiciantes.php'); ?>
		</div> 
		<div id="gf" onclick="location.href='index.php'" style="cursor:pointer"></div>
		<div id="pie_repetir" style="float:left">
		  <div id="pie"></div>
		</div>
    </div>
  </div>
</form>
</body>