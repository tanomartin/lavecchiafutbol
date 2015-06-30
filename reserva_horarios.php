<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	
	$modulo = "reserva";
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new TorneoCat();
	$id = $oObj->obtenerIdCat($_POST['id'],$oTorneo->id_torneo,$idCatPadre);

	$oObj = new Equipos();
	$aEquipos = $oObj->getTorneoCat($_POST['id']);
	
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
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'/></script>
<script type="text/javascript" src="_js/funciones.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script>

function cambiar(id){
	document.getElementById('id').value=id;
	document.form_alta.submit();
}

function cambiar_menu(url){
	document.form_alta.action = url;
	document.form_alta.submit();
}

jQuery(function($){	
	$("#ingresar").click(function() {
  		$("#error").html("");
		var pwd = $("#pwd").val();
		var equipo = $("#equipo").val();
		var id = $("#id").val();
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: "reserva_control_ingreso.php",
			data: {pwd:pwd, equipo:equipo, id:id},
		}).done(function(respuesta){
			if (respuesta == 0) {
				document.form_alta.action = "reserva_menu.php";
				document.form_alta.submit();
			} else {
				$("#error").html(respuesta);
				$("#equipo").val(0);
				$("#pwd").val("");
			}
		});
	});
});

function pulsar(e) { 
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
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
      <div id="menu_izq1" style="float:left"><img  src="logos/<?= $oTorneo->logoPagina?>" />
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
        <br />
        <div id="reserva" style="margin-left:50px">
          <div class="titulo_reserva color_titulo_reserva_<?= $color ?>">RESERVA DE HORARIO DE PARTIDO</div>
          <br />
          <div align="center">
            <p>
            <div id="error" style="color:#FF0000; font-weight:bold"></div>
            </p>
            <p>
              <select name="equipo" id="equipo">
                <option value="0" selected="selected">Seleccione Su Equipo</option>
                <? if($aEquipos != NULL) {
									 foreach ($aEquipos as $equipo) { ?>
                <option value=<? echo $equipo['id']?>><? echo $equipo['nombre']?> </option>
                <?	}	
							  }?>
              </select>
            </p>
            <p>
              <input type="password" id="pwd" name="pwd" placeholder="Contraseña" style="text-align:center" onkeypress="return pulsar(event)">
            </p>
            <p>
			 <img id="ingresar" src='img/reservas/boton_entrar.jpg' border='0' width="135" height="34" style="cursor:pointer" />
             <!--<input type="button" name="ingresar" id="ingresar" value="Ingresar"/>-->
            </p>
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
