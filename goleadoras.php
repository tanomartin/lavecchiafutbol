<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/equipos.php";
	include_once "model/resultados.php";	
	include_once "model/pantallasFijas.php";
	include_once "model/resultados.php";	
	
	$modulo = "goleadoras";

	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new Equipos();
	$aEquipos = $oObj->getTorneoCat($_POST['id']);
	
	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);
	$color = $oTorneo->color;

	$oResultado= new Resultados();
	$goleadoras = $oResultado->goleadoras($_POST["id"]);



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
<link rel="stylesheet" href="css/goleadoras.css" type="text/css">
<link rel="stylesheet" href="css/interno.css" type="text/css">
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'/></script>
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
									$aCategoriasMenu = $oObj->getByTorneo( $aTorneos[$i][id],"id_categoria");
									
								?>
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
						 if($aCategorias[$i][id] == $_POST['id']) { 
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
        <div style="float:left; margin-left:10px">
          <div id="goleadoras_<?= $color ?>" style="clear:both"></div>
          <? for ($i=0; $i<count($goleadoras); $i++) {
			
					$pos=1;
					
					if (($i % 2) == 0) $pos=0; 
					
					$nro = $i + 1;
					
			   ?>
          <div class="goleadora_<?= $color ?>_<?= $pos ?>">
            <div class="posicion posicion_color_<?=$pos?>">
              <?= ($nro<10)? "0".$nro: $nro?>
            </div>
            <div class="nombreJugadora posicion_color_1">
              <?= $goleadoras[$i][nombre]  ?>
            </div>
            <div class="nombreEquipo posicion_color_1">
              <?= $goleadoras[$i][nombreEquipo]  ?>
            </div>
            <div class="goles posicion_color_1">
              <?= $goleadoras[$i][goles] ?>
            </div>
            <div class="partidos color_<?= $color ?>">
              <?= $goleadoras[$i][partidos]?>
            </div>
          </div>
          <? } ?>
        </div>
      </div>
	  <div id="auspiciantes">
		<div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
		  <? include('auspiciantes.php'); ?>
		</div>
	  </div>
    </div>
  <? include_once('pie.php') ?>
  </div>
</form>
</body>
