<?	include_once "include/config.inc.php";
	include_once "model/noticias.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	
	$oObj = new Noticias();
	$noti = $oObj->getByCant(5);


	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: La Vecchia Futbol ::</title>
<meta name="author" content="gambetafemenina.com">
<meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física">
<meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres">
<style type="text/css">
	
	#cabezal1 {
		width:920px;
		height:275px;
		margin:0 auto 0 auto;
	}
	
	#cabezal2 {
		width:999px;
		height:44px;
		margin:0 auto 0 auto;
	}
	
	#cabezal3 {
		width:999px;
		margin:0 auto 0 auto;
	}

	#imagen {
		background-repeat:no-repeat;
		width:767px;
		height:275px;
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

	#noticias {
		width:531px;
		margin:0 0 16px auto;
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
		width:145px;
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
	
</style>

<link href="css/home.css" rel="stylesheet" type="text/css">
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'/></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jrumble.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script language="javascript">

	function pagina(id){
		document.getElementById('id').value= id;		
		document.frm1.submit();
	}
	
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	}); 
	
</script>
</head>
<body align="center" bgcolor="#FFFFFF" border=0 style="width:100%; height:100%" >
<? include_once "include/analyticstracking.php"; ?>
<div id="wrap">
  <? include_once "botonera.php" ?>
  <div id="cabezal1">
    <div id="imagen" style="float:left; margin-bottom:15px"> 
		<img src="img/home/foto.jpg" alt="" title="" width="920" height="275" /> 
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
      <div align="center"><img src="img/home/sinnoticias.jpg" width="400px" height="400px" /></div>
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
					<div class="<?= $class_titulo ?>"><?= $noti[$i]['titulo'] ?></div>
					<div class="<?= $class_desarrollo ?>"><?= $noti[$i]['desarrollo'] ?></div>
					<hr  class="<?= $class_linea ?>"/>
					<div class="<?= $class_fecha ?>"><?= $noti[$i]['fecha'] ?></div>
					<span class="bottom"><span></span></span> 
				  </div>
				  <br />
      <? }
	  } ?>
    </div>
    <div id="torneos">
      <? if (count( $aTorneos ) == 0) { ?>
      <div><img src="img/home/sintorneos.jpg"  width="200px" height="200px" />
        <?	} else {
			for ($i=0; $i<count( $aTorneos ); $i++) { 
				$oObj = new TorneoCat();
				$categoria = $oObj ->getByTorneo($aTorneos[$i][id]); ?>
        <div align="center"><img src="logos/<?= $aTorneos[$i]['logoPrincipal'] ?>"  width="80px" height="80px" style="margin-top:5px; margin-bottom:5px" />
          <div><span class="tituloHome<?= $aTorneos[$i]['color'] ?>">
            <?= strtoupper ($aTorneos[$i]['nombre'] ) ?>
            </span></div>
          <hr class="linea" width="150px">
          </hr>
          <? for ($c=0; $c<count( $categoria); $c++) { ?>
          <div class="categoria" onclick="pagina('<?= $categoria[$c][id]?>')">
            <?= strtoupper ($categoria[$c][nombreCorto]); ?>
            <hr class="linea" width="150px">
            </hr>
          </div>
          <? }  ?>
        </div>
        <? } 
		  } ?>
      </div>
    </div>
    <div id="auspiciantes" style="float:left">
      <? include('auspiciantes.php'); ?>
    </div>
  </div>
  <? include_once('pie.php') ?>
</div>
</div>
<form name="frm1" id="frm1" method="post" action="noticias.php">
  <input name="id"  id="id" type="hidden" />
</form>
</body>
