<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	
	
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	
/*print_r($rosa); echo "avavav<br>";
print_r($grises);*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: La Vecchia Futbol ::</title>
<meta name="author" content="gambetafemenina.com">
<meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física">
<meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres">
<link rel="stylesheet" href="css/home.css" type="text/css">
<link rel="stylesheet" href="css/menu_izq.css" type="text/css">
<link rel="stylesheet" href="css/equipos.css" type="text/css">
<link rel="stylesheet" href="css/paginas.css" type="text/css">
<style type="text/css">
	
	#cabezal1 {
		width:999px;
		margin:0 auto 0 auto;
	}

	#imagen {
		float:left;		
		width:570px;
		margin-top:5px;
		margin-left:-25px;
	}

	#titulo_auspiciante {
		background-image:url(img/home/titulo_auspiciante.jpg);
		background-repeat:no-repeat;
		width:185px;
		height:44px;;
		margin:0px 0px 0px -9px;
		text-align:left;	
		float:left;	
	}
	
	#auspiciantes {
		width:210px;
		margin:0px 0px 0px 240px;
		text-align:left;	
		float:left;	
	}

</style>
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'/>
<script type="text/javascript" src="_js/funciones.js"></script>
<script type='text/javascript'> 
	function pagina(id){
		document.getElementById('id').value= id;		
		document.form_alta.action = "noticias.php";
		document.form_alta.submit();
	}
	
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	});    
</script>

</head>
<body align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
  <div id="wrap">
    <? include_once "botonera.php" ?>
    <div id="cabezal1" style="margin-top:5px" align="center">
      <div id="menu">
        <? for ($i=0; $i<count( $aTorneos ); $i++) {   
					$oObj = new TorneoCat();
					$categoria = $oObj ->getByTorneo($aTorneos[$i][id]); ?>
        <img src="logos/<?= $aTorneos[$i]['logoMenu'] ?>"  border="0" width="43px" height="54px" onclick="pagina('<?= $categoria[0][id]?>')" style="cursor: pointer"/>
        <? } ?>
      </div>
      <div id="imagen" style="float:left; vertical-align:top">
        <div style="float:left; margin-left:48px"> <img src="img/quienes_somos/quienes_somos.jpg" /> </div>
      </div>
      <div id="auspiciantes">
        <div id="titulo_auspiciante"></div>
        <? include('auspiciantes.php'); ?>
      </div>
    </div>
    <? include_once('pie.php') ?>
  </div>
  </div>
<form id="form_alta" name="form_alta" action="" method="post">
  <input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
  <input name="color" id="color"  value="<?= $color ?>" type="hidden" />
  </form>
</body>
