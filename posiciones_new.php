<?	include_once "include/config.inc.php";
	include_once "include/fechas.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/equipos.php";
	include_once "model/fixture.php";
	include_once "model/posiciones.php";
	include_once "model/parametros.php";
	
	$modulo = "posiciones";

	$oObj = new Torneos();
	
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);
	$color = $oTorneo->color;
	
	$fecha =(isset($_POST['fecha']))? $_POST['fecha']: $fecha;
	$idFecha = $fecha -1;

	$oObj1 = new Posiciones();
	$aTabla = $oObj1->armarTabla($_POST['id']);
	
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
<link rel="stylesheet" href="css/posiciones.css" type="text/css">
<link rel="stylesheet" href="css/paginas.css" type="text/css">
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

function paginar(id){
	document.getElementById('fecha').value=id;
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
  <input name="fecha" id="fecha"  value="<?= $fecha ?>" type="hidden" />
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
        <div style="height:10px">&nbsp;</div>
        <div id="posicion_<?= $color ?>" style="clear:both"></div>
        <? for ($p=0; $p<count($aTabla); $p++) {
			
					$class = "pos1";
					$num = $p+1;
					
					if ($num<10) $num = "0".$num;
					
					
					if ( ( $p % 2) == 0 )	$class = "pos0";
			   ?>
        <div id="linea">
          <div class="pos_detalle pos_color_<?= $color ?>">
            <?= $num  ?>
            .</div>
          <div  id="pos_detalleEquipo" class="<?= $class ?>">
            <?= $aTabla[$p][nombre] ?>
          </div>
          <div id="posicion_pj" class="pos_color_<?= $color ?>">
            <?= $aTabla[$p][par_perdidos]  +  $aTabla[$p][par_empatados] +   $aTabla[$p][par_ganados]  ?>
          </div>
          <div id="par_ganados" class="verde">
            <?= $aTabla[$p][par_ganados]  ?>
          </div>
          <div id="par_perdidos" class="rojo">
            <?= $aTabla[$p][par_perdidos]  ?>
          </div>
          <div id="par_empatados" class="gris">
            <?= $aTabla[$p][par_empatados]  ?>
          </div>
          <div id="goles_favor" class="verde">
            <?= $aTabla[$p][goles_favor]  ?>
          </div>
          <div id="goles_contra" class="rojo">
            <?= $aTabla[$p][goles_contra]  ?>
          </div>
          <div id="goles_diferencia" class="gris">
            <?= $aTabla[$p][goles_favor] - $aTabla[$p][goles_contra]  ?>
          </div>
          <div id="posicion_puntaje" class="pos_color_<?= $color ?>">
            <?= $aTabla[$p][puntaje]  ?>
          </div>
        </div>
        <? } ?>
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
