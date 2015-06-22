<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/equipos.php";
	include_once "model/fixture.php";	
	include_once "model/pantallasFijas.php";
	
	$modulo = "resultados";

	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new Equipos();
	$aEquipos = $oObj->getTorneoCat($_POST['id']);
	
	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);
	$color = $oTorneo->color;

	$oObj1 = new Fixture();

	if ($aEquipos) 
		$aFixture = $oObj1->getByEquipo($_POST['id'],$aEquipos[0]['id']);


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
<link rel="stylesheet" href="css/resultados.css" type="text/css">
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


function createInstance() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function cambiarResultado(idEquipo){
	var xhr;
	xhr = createInstance();
	xhr.open("POST","cargarResultado.php",false);
	xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	var id = document.getElementById('id').value;
	var color = document.getElementById('color').value;
	xhr.send("id="+id+"&color="+color+"&idEquipo="+idEquipo);
	window.document.getElementById("resultados").innerHTML = xhr.responseText;
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
        <div style="float:left; margin-left:50px; margin-top:20px">
          <div id="equipos" style="float:left">
            <? for ($i=0; $i<count($aEquipos);$i++) {
                    		$clase  = 1;
                            if ($i % 2 == 0 )
                            	$clase = "0";
                        ?>
            <div id=linea style="height:20px; width:125px; padding:7px; cursor:pointer" class="resultado_<?= $color ?>_<?= $clase?>" onclick="cambiarResultado(<?= $aEquipos[$i]['id'] ?>)" >
              <?= $aEquipos[$i]['nombre'] ?>
            </div>
            <? } ?>
          </div>
          <div id="resultados" style="float:right; margin-left:10px" >
            <? for ($i=0; $i<count($aFixture);$i++) { 
                        ?>
            <div id=linea style="height:19px; width:355px; padding:7px; border-top: #CCC 1px solid" >
              <? if ($aFixture[$i]['idEquipo1']  == $aEquipos[0]['id']) { ?>
              <div style="width:155px; text-align:left; float:left" class=" resultado_equipo resultado_color_<?=$color?>">
                <?= $aFixture[$i]['equipo1'] ?>
              </div>
              <div style="width:15px; text-align:center; float:left" class=" resultado_equipo resultado_color_<?=$color?>"><b>
                <?= ($aFixture[$i]['golesEquipo1']<0)? "-" :$aFixture[$i]['golesEquipo1'] ?>
                </b></div>
              <div style="width:10px; text-align:left; float:left">&nbsp;</div>
              <div style="width:15px; text-align:center; float:left"  class="resultado_equipo"><b>
                <?= ($aFixture[$i]['golesEquipo2']<0)? "-" :$aFixture[$i]['golesEquipo2']  ?>
                </b></div>
              <div style="width:155px; text-align: right; float:left" class="resultado_equipo">
                <?= $aFixture[$i]['equipo2'] ?>
              </div>
              <? } else  {?>
              <div style="width:155px; text-align:left; float:left" class=" resultado_equipo resultado_color_<?=$color?>">
                <?= $aFixture[$i]['equipo2'] ?>
              </div>
              <div style="width:15px; text-align:center; float:left" class=" resultado_equipo resultado_color_<?=$color?>"><b>
                <?= ($aFixture[$i]['golesEquipo2']<0)? "-" :$aFixture[$i]['golesEquipo2']  ?>
                </b></div>
              <div style="width:10px; text-align:left; float:left">&nbsp;</div>
              <div style="width:15px; text-align:center; float:left"  class="resultado_equipo"><b>
                <?= ($aFixture[$i]['golesEquipo1']<0)? "-" :$aFixture[$i]['golesEquipo1'] ?>
                </b></div>
              <div style="width:155px; text-align: right; float:left" class="resultado_equipo">
                <?= $aFixture[$i]['equipo1'] ?>
              </div>
              <? } ?>
            </div>
            <? } ?>
            <div id=linea style="height:19px; width:355px; padding:7px; border-top: #CCC 1px solid" ></div>
          </div>
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
