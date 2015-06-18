<?	include_once "include/config.inc.php";
	include_once "model/noticias.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	
	$oObj = new Noticias();
	$noti = $oObj->getByCant(5);


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
		left: 750px;
		top: 5px;
		width: 170px;
		height: 25px;
		cursor: pointer;
		background-color:#F00
	}	
	
	#reglamento { 
		position: relative;
		left: 750px;
		top: 15px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		background-color:#F00;
		cursor: pointer;
	}	

	#sedes { 
		position: relative;
		left: 750px;
		top: 25px;
		width: 170px; 
		height: 25px;
		text-align:left;
		background-color:#F00;
		cursor: pointer;
	}	

	#contacto { 
		position: relative;
		left: 750px;
		top:  33px;
		width: 170px; 
		height: 25px;
		text-align:left;
		background-color:#F00;
		cursor: pointer;
	}	


	#cabezal1 {
		width:920px;
		height:275px;
		margin:0 auto 0 auto;
	}

	#imagen {
		/*background-image:url(img/home/imagen.jpg);*/
		background-repeat:no-repeat;
		width:767px;
		height:275px;
		margin:0 auto 0 auto;
	}

	#faceytweet {
		background-image:url(img/home/faceytweet.jpg);
		background-repeat:no-repeat;
		width:190px;
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
		width: 56px; 
		height: 90px;
		text-align:left;
	}

	#twitter { 
		position: relative;
		left: 110px; 
		top: -10px; /*442*/ 
		width: 56px; 
		height: 90px;
		text-align:left;
	}

	#fecha { 
		position: relative;
		left: 48px; 
		top: -280px; /*442*/ 
		width: 125px; 
		height: 10px;
		text-align:left;
	}

	#cabezal2 {
		width:999px;
		height:44px;
		margin:0 auto 0 auto;
	}

	#titulo_cartelera {
		background-image:url(img/home/titulo_cartelera.jpg);
		background-repeat:no-repeat;
		width:581px;
		height:44px;
		margin:0 auto 0 auto;
		float:left
	}

	#titulo_torneo {
		background-image:url(img/home/titulo_torneo.jpg);
		background-repeat:no-repeat;
		width:185px;
		height:44px;;
		margin:0 -18px 0 18px;
		float:left
	}

	#titulo_auspiciante {
		background-image:url(img/home/titulo_auspiciante.jpg);
		background-repeat:no-repeat;
		width:185px;
		height:44px;;
		margin:5px 0px 0px 9px;
		text-align:left;
		float:left		
	}

	#cabezal3 {
		width:999px;
		margin:0 auto 0 auto;
	}

	#noticias {
		width:531px;
		margin:0 auto 0 auto;
		float:left;
		margin-left:40px;
	}

	#torneos {
		float:left; 
		text-align:center;
		width:205px;
		margin:0 -11px 0 20px;
	}

	#categoria {
		width: 150px;
		margin: 7px auto auto 7px;
	}

	#auspiciantes {
		width:210px;
		margin:0px 0px 0px 0px;
		text-align:left;		
	}

	/* En este contenedor va todo lo que queremos mostrar. No le damos margen vertical puesto ese lo generarán los span del borde */
	div.contenido{ 
	   margin:10px;
	}
	/* Generamos los estilos de las span, los cuales contendrán las imágenes GIF */
	span.top, span.bottom{
	   width:100%;
	   height:4px; /* El alto debe ser la mitad de alto de la imagen GIF */
	   display:block;
	}
	/* A continuación viene el verdadero truco, la posición de las imágenes de fondo es importante*/
	span.top {
	   background:url(img/home/si.gif) top left no-repeat; 
	}
	span.bottom{
	   background:url(img/home/ii.gif) bottom left no-repeat;
	}
	span.top span, span.bottom span{
	   width:4px; /* De acuerdo al tamaño de la imagen GIF */
	   height:4px;/* De acuerdo al tamaño de la imagen GIF */
	   float:right;
	   font-size:4px; /* Esto es para IE6, que no respeta el height del span si el tamaño de letra es mayor a este  */
	}
	span.top span{
	   background:url(img/home/sd.gif) top right no-repeat;
	}
	span.bottom span{
	   background:url(img/home/id.gif) bottom right no-repeat;
	}

	#gf{ 
		left: 320px;
		top:  -100px;
		position: relative;
		width: 300px; 
		height: 184px;
		cursor:pointer; 
		background:#993300;
	}


	#pie_repetir { margin:0 auto 0 auto; width:100%; height:70px;
			background-image:url(img/home/pie1.jpg);
			background-repeat:repeat-x;
   }

	#pie{
		background-image:url(img/home/pie.jpg);
		background-repeat:no-repeat;
		width:999px;
		height:70px;
		margin:0 auto 0 auto;
	}
-->
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jrumble.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script language="javascript">
//Efecto slide de fotos Jquery	
$(document).ready(function() {
	$('#slideH').cycle({ 
		fx: 'scrollLeft', 
		timeout: 5000 
	});
});

	function pagina(id){
		document.getElementById('id').value= id;		
		document.frm1.submit();
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
<body align="center" bgcolor="#FFFFFF" border=0 style="width:100%; height:100%" >
<?php include_once "include/analyticstracking.php"; ?>
<div id="wrap">
  <div id="encabezado">
    <div id="cabezal">
    	<div id="quienes_somos" onclick="window.location = 'quienes_somos.php';"></div>
      	<div id="reglamento" onclick="window.location = 'reglamento.php';"></div>
      	<div id="sedes" onclick="window.location = 'sedes.php';"></div>
      	<div id="contacto"  onclick="window.location = 'contacto.php';"></div>
		<div id="gf" onclick="location.href='index.php'"></div>
    </div>
  </div>
  <div id="cabezal1">
    <div id="imagen" style="float:left; margin-bottom:15px"> <img src="img/home/foto.jpg" alt="" title="" width="920" height="275" />
  </div>
  </div>
  <div id="cabezal2">
    <div id="titulo_cartelera"></div>
    <div id="titulo_torneo"></div>
    <div id="titulo_auspiciante"></div>
  </div>
  <div id="cabezal3">
    <div id="noticias">
      <? if (count($noti) == 0) { ?>
	  		<div align="center"><img src="img/home/sintorneos.png" width="400px" height="400px" /></div>
	  <? } else {
	  		for ($i=0; $i<count($noti); $i++ ) {
                  $class = "gris2";
				  $class_titulo = "noticias_titulo";
				  $class_desarrollo = "noticias_desarrollo";				  
				  $class_fecha = "fecha_noticia";				  
				  $class_linea = "noticia_linea";
				  
				  if ($noti[$i][posicion] == 1) {
                      $class = "rosa";
					  $class_titulo = "noticias_titulo1";					  
					  $class_desarrollo = "noticias_desarrollo1";
					  $class_fecha = "fecha_noticia1";		
					  $class_linea = "noticia_linea1";
				  } else {
                    if ( ( $i % 2 ) == 0 )
                      $class = "gris1";
                  }?>
			
			  <div class="<?= $class ?>"> 
			  	<span class="top"><span></span></span>
				<div class="<?= $class_titulo ?>">
				  <?= $noti[$i]['titulo'] ?>
				</div>
				<div class="<?= $class_desarrollo ?>">
				  <?= $noti[$i]['desarrollo'] ?>
				</div>
				<hr  class="<?= $class_linea ?>"/>
				<div class="<?= $class_fecha ?>">
				  <?= $noti[$i]['fecha'] ?>
				</div>
				<span class="bottom"><span></span></span> </div>
			  <br />
      			<? }
	  } ?>
    </div>
    <div id="torneos">
      <? if (count( $aTorneos ) == 0) { ?>
	  		<div><img src="img/home/sintorneos.png"  width="200px" height="200px" />
	   <?	} else {
			for ($i=0; $i<count( $aTorneos ); $i++) { 
				$oObj = new TorneoCat();
				$categoria = $oObj ->getByTorneo($aTorneos[$i][id]); ?>
				<div align="center"><img src="logos/<?= $aTorneos[$i]['logoPrincipal'] ?>"  width="90px" height="95px" />
				<div><span class="tituloHome<?= $aTorneos[$i]['color'] ?>"><?= strtoupper ($aTorneos[$i]['nombre'] ) ?></span></div>
				 <hr class="linea" width="150px"></hr>
				 <? for ($c=0; $c<count( $categoria); $c++) { ?>
					<div class="categoria" onclick="pagina('<?= $categoria[$c][id]?>')">
						  <?= strtoupper ($categoria[$c][nombreCorto]); ?>
						  <hr class="linea" width="150px"></hr>
					</div>
				<?	 }  ?>
				</div>	
		  <? } 
		  } ?>
      </div>
    </div>
    <div id="auspiciantes" style="float:left">
      <? include('auspiciantes.php'); ?>
    </div>
  </div>
  <div id="pie_repetir" style="float:left">
    <div id="pie">
		<a href="http://www.facebook.com" target="_blank"><img src="img/home/facebook.png" style="width:40px; height:40px; float:left; margin-top:20px; margin-left:420px" /></a>
		<a href="http://www.twitter.com" target="_blank"><img src="img/home/twitter.png" style="width:40px; height:40px; float:left; margin-top:20px; margin-left:15px" /></a>
		<a href="mailto:info@lavecchiafutbol.com.ar"><img src="img/home/mail.png" style="width:40px; height:40px; float:left; margin-top:20px; margin-left:15px" /></a>
	</div>
  </div>
</div>
<form name="frm1" id="frm1" method="post" action="noticias.php">
  <input name="id"  id="id" type="hidden" />
</form>
</div>
</body>
