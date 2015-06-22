<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/noticias.php";
	
	$modulo = "noticias";
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new TorneoCat();
	$id = $oObj->obtenerIdCat($_POST['id'],$oTorneo->id_torneo,$idCatPadre);

	$oObj = new Noticias();
	$noti = $oObj->getByCant(5,$idCatPadre);
	
	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);

	$color = $oTorneo->color;
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
<link rel="stylesheet" href="css/paginas.css" type="text/css">
<link rel="stylesheet" href="css/interno.css" type="text/css">
<style type="text/css">

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
	
	.caja { 
		width: 520px; 
		background-image: url("img/home/centro.jpg"); 
		background-repeat: repeat-y; 
	} 

	.cajaarriba { 
		background-image: url("img/home/arriba.jpg"); 
		background-position: top center; 
		background-repeat: no-repeat; 
	} 

	.cajaabajo { 
		background-image: url("img/home/abajo1.jpg"); 
		background-position: bottom left; 
		background-repeat: no-repeat;
		padding-top:10px;
		padding-bottom:5px;
		margin-left:-1px	
	
	} 
	
-->
</style>
<script type="text/javascript" src="_js/funciones.js"></script>
<script>
function cambiar(id){
	document.getElementById('id').value=id;
	document.form_alta.submit();
}

function cambiar_menu(url){
	document.form_alta.action = url;
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
<?php include_once "include/analyticstracking.php"; ?>
<form id="form_alta" name="form_alta" action="" method="post">
  <input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
  <input name="color" id="color"  value="<?= $color ?>" type="hidden" />
  <div id="wrap">
    <? include_once "botonera.php" ?>
    <div id="cabezal1">
      <div id="menu_izq1" style="float:left"> <img  src="logos/<?= $oTorneo->logoPagina?>" />
        <? include("menu_izq.php") ?>
      </div>
      <div id="imagen" style="float:left; vertical-align:top">
        <div id="titulo_principal">
          <div  style="float:center;height:43px" align="center">
            <? for ($i = 0; $i <count( $aTorneos ); $i++) {
                            if ( $oTorneo->id_torneo != $aTorneos[$i][id] ) {
								$aCategoriasMenu = $oObj->getByTorneo( $aTorneos[$i][id],"id_categoria");?>
            <img  src="logos/<?= $aTorneos[$i][logoMenu]?>"  onclick="cambiar(<?= $aCategoriasMenu[0][id]?>)" style="cursor:pointer" />
            <? } 
                        } ?>
          </div>
        </div>
        <div class="titulo_pagina color_titulo_<?= $color ?>" >
          <?=  strtoupper($oTorneo->nombre_pagina) ?>
        </div>
        <div id="categorias">
          <div class="titulo_categoria color_categoria" style="float:left;">CATEGORIA</div>
          <? for ($i=0; $i<count($aCategorias);$i++) {
						 if($aCategorias[$i][id] == $id) { 
						?>
          <div style="float:left" class="color_categoria_seleccionada_<?= $color ?>">
            <? if ( $aCategorias[$i][nombreCatPagina] != "" ) { echo strtoupper($aCategorias[$i][nombreCatPagina]). "-";} ?>
            <?= strtoupper($aCategorias[$i][nombrePagina]) ?>
          </div>
          <? } else { ?>
          <div style="float:left; cursor:pointer" class="categoria_submenu" onclick="cambiar(<?= $aCategorias[$i][id]?>)">
            <? if ( $aCategorias[$i][nombreCatPagina] != "" ) { echo strtoupper($aCategorias[$i][nombreCatPagina]). "-";} ?>
            <?= strtoupper($aCategorias[$i][nombrePagina]) ?>
          </div>
          <? }
						
							if ($i+1 < count($aCategorias)) { ?>
          <div style="float:left" class="categoria_linea_<?= $color ?>">|</div>
          <? } 
					}?>
        </div>
        <br />
        <div id="noticias" style="float:left; margin-left:50px">
          <? for ($i=0; $i<count($noti); $i++ ) { 
                          $class_titulo = "noticias_titulo";
                          $class_desarrollo = "noticias_desarrollo";				  
                          $class_fecha = "fecha_noticia";				  
                          $class_linea = "noticia_linea";
	                          
                          if ($noti[$i][posicion] == 1) {
                              $class = "color_noticias_".$color ;
                              $class_titulo = "noticias_titulo1";					  
                              $class_desarrollo = "noticias_desarrollo1";
                              $class_fecha = "fecha_noticia1";		
                              $class_linea = "noticia_linea1";
                          }
       			            if ($noti[$i][posicion] == 1) {
       			          ?>
          <div class="<?= $class ?>"> <span class="top"><span></span></span>
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
          <? } else { ?>
          <div class="caja">
            <div class="cajaarriba">
              <div class="cajaabajo">
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
              </div>
            </div>
          </div>
          <? } ?>
          <br />
          <? } ?>
        </div>
      </div>
		 <div id="auspiciantes">
			 <div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
			<? include('auspiciantes.php'); ?>
		  </div>
    </div>
    
   <? include_once('pie.php') ?>
  </div>
</form>
</body>
