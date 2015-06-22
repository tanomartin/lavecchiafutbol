<?  include_once "include/config.inc.php";
	include_once "include/fechas.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	include_once "model/categorias.php";
	include_once "model/fechas.php";
	include_once "model/reservas.php";
	include_once "model/fixture.php";
	include_once "model/sedes.php";
	
	if(!session_is_registered("equipo")){
		header("Location: index.php");
		exit;
	}
	
	//OBTENGO EL TORENO CON SU ZONA Y CATETEGORIA
	$oObj = new Torneos();
	$oTorneo = $oObj->getByTorneoCat($_SESSION['id']);
	$idTorneo = $oTorneo->id_torneo;
	$idZona = $oTorneo->id_categoria;
	$idCategoria = $oTorneo->id_padre;
	$torneo = $oObj->get($idTorneo);
	$oCategoria = new Categorias();
	$zona = $oCategoria->get($idCategoria);
	$categoria = $oCategoria->get($idZona);

	//OBTENGO EL EQUIPO
	$oEquipo = new Equipos();
	$equipo = $oEquipo->getById($_SESSION['equipo']);
	
	//OBTENGO LA FECHA ACTIVA
	$oFechas = new Fechas();
	$fecha_activa = $oFechas->getFechaActiva($_SESSION['id']);
	
	//CONTROLO QUE EXISTA UNA FECHA ACITVA
	if ($fecha_activa!=NULL) {
		//VEO SI YA EXISTE PARTIDO
		$oFixture = new Fixture();
		$partido = $oFixture->getByFechaEquipo($fecha_activa["id"],$_SESSION['equipo']);
		//VEO SI EXISTE UNA RESERVA PARA ESTE EQUIPO
		if ($partido == NULL) {	
			$idReserva = $oEquipo->tieneReserva($fecha_activa["id"],$_SESSION['equipo']);
			if ($idReserva == 0) {
				//OBETENGO HORAS Y SI EL EQUIPO YA PIDIO FECHA LIBRE PARA ESTE TORNEO
				$horas_fecha = $oFechas->getHorasCancha($fecha_activa["id"]);
				$fechaLibre = $oEquipo->tieneFechaLibre($_SESSION['id'],$_SESSION['equipo']);
			} else {
				//OBTENGO LA RESERVA
				$oReserva = new Reservas();
				$reserva = $oReserva->getReservaById($idReserva);
				if ($reserva->fecha_libre == 0) {
					//OBTENGO EL DETALLE DE LA RESERVA
					$detalleReserva = $oReserva->getDetalleReservaById($idReserva);
				}
			}
		}
	}
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
<link rel="stylesheet" href="css/equipos.css" type="text/css">
<link rel="stylesheet" href="css/fixture.css" type="text/css">
<link rel="stylesheet" href="css/interno.css" type="text/css">	
<script type="text/javascript" src="_js/funciones.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script>

function controlLibre() {
 	$('#error').html("");
	var grupo = document.getElementById("carga_reserva").horas;
	var controlCheck = 0;
	for (i = 0; lcheck = grupo[i]; i++) {
        if (lcheck.checked) {
            controlCheck = 1;
        }
    }
	if (controlCheck == 1) {
		document.getElementById("libre").disabled = true;
	} else {
		document.getElementById("libre").disabled = false;
	}
}

function controlHoras() {
	$('#error').html("");
	var libre = document.getElementById("libre");
	var grupo = document.getElementById("carga_reserva").horas;
	var total = grupo.length;
	if (libre.checked) { 	
		if (total == null) {
			grupo.disabled = true;
		} else {
			for (i = 0; lcheck = grupo[i]; i++) {
				lcheck.disabled = true;
			}
		}
	 } else {
	 	if (total == null) {
			grupo.disabled = false;
		} else {
			for (i = 0; lcheck = grupo[i]; i++) {
				lcheck.disabled = false;
			}
		}
	 }
}

function validar(formulario) {
	$('#error').html("");
	var libre = document.getElementById("libre");
	var grupo = document.getElementById("carga_reserva").horas;
	if (libre != null) {
		if (libre.checked) { 	
			return true;
		} else {
			var controlCheck = 0;
			for (i = 0; lcheck = grupo[i]; i++) {
				if (lcheck.checked) {
					controlCheck++;
				}
			}
			if (controlCheck < 4) {
				$('#error').html("* Debe seleccionar como mínimo 4 horas");
				return false;
			} else {
				return true;
			}
		}	
	} else {
		var controlCheck = 0;
		for (i = 0; lcheck = grupo[i]; i++) {
			if (lcheck.checked) {
				controlCheck++;
			}
		}
		if (controlCheck < 4) {
			$('#error').html("* Debe seleccionar como mínimo 4 horas");
			return false;
		} else {
			return true;
		}
	}
}

function logout() {
	var direccion = "logout.php";
	location.href = direccion;
}


function confirmarPartido(idPartido) {
	var direccion = "reserva_confirma_partido.php?idPartido="+idPartido;
	location.href=direccion;
}

</script>

</head>
<body align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
<form id="carga_reserva" name="carga_reserva" onsubmit="return validar(this)" action="reserva_guardar.php" method="post">
	<div id="wrap">
		 <? include_once "botonera.php" ?>
		 <div id="cabezal1">
  			<div id="menu_izq1"><img  src="logos/<?= $oTorneo->logoPagina?>" /></div>
			<div id="imagen">
            	<div id="titulo_principal" class="titulo_pagina color_titulo_<?= $color ?>" style="margin-left:0px">
                    <div  style="float:left; bottom:0px; position:absolute;" >
						<?=  strtoupper($oTorneo->nombre_pagina)." - ".$zona[0]["nombreLargo"]." - ".$categoria[0]["nombreLargo"] ?>
					</div>
                </div>
				<br>
			   	<div id="reserva" style="margin-bottom:60px">	
					<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">
						<font color="#000000"><?= strtoupper ($equipo->nombre) ?></font> | <? echo $fecha_activa["nombre"] ?>
					</div>
					<a class="enlace" href="#" onclick="logout()"><img src="img/icon-logout.png" title="salir" width="40" height="40" border="0" alt="enviar" style="float:right"></a><br />
					<br />
			     <? if ($fecha_activa != NULL && $idReserva == 0 && $partido == NULL) {	?>
						<input type="text" id="id_fecha" name="id_fecha" value="<?= $fecha_activa["id"] ?>" style="visibility:hidden"/>
					<?  if ($horas_fecha != NULL) { ?>
							<div class="titulo_reserva" style="float:left;">Horarios Disponibles</div>
							<div id="error" style="color:#CC3300; font-weight:bold; margin-bottom:10px" align="left"></div>
							<div style="text-align:left; width:500px">	
								<?	
								$i = 1;
								foreach ($horas_fecha as $hora) {
									print("<input type='checkbox' id='horas' name='hora".$hora["id_horas_cancha"]."' value='".$hora["id_horas_cancha"]."' onclick='controlLibre()'> ".$hora["descripcion"]." | </input>");
									$resto = $i % 4;
									if ($resto == 0) {
										print("<br>");
									}
									$i++;
								 }  ?>							
							</div>
					 <?	} ?>
						<br />
					 <? if (!$fechaLibre) { ?>
							<div class="titulo_reserva" style="float:left;">
								Fecha Libre <input type='checkbox' name='libre' id='libre' value='libre' onclick='controlHoras()'></input>
							</div>
					 <? } else { ?>
							<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">
								El equipo ya pidio fecha libre
							</div>
					 <? } ?> 
						<br /><br />
						<div style="float:left;">
							<textarea name="observacion" id="observacion" placeholder="Observacion" cols="62" rows="4" style="float:left;"></textarea>
						</div>
						<br /><br /><br /><br />
						<div style="float:left;">
							<input type="submit" name="reservar" value="Reservar" />
						</div>
				<? } else { 
						if ($fecha_activa == NULL) {?>
							<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">
								No hay fecha activa
							</div>
					 <? } else { 
						 	if($partido == NULL) {  ?>	
								<div style="text-align:left; width:500px">
							 <? if ($reserva->fecha_libre == 1) { ?>
									<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">
										El equipo pidio Fecha Libre
									</div>
									<br />
							 <? } else {
									 if ($reserva->fecha_libre == 2) { ?>
										<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">
											La organizacion otorgó Fecha Libre
										</div>
										<br />
								  <? } else { ?>
										<div class="titulo_reserva" style="float:left;">Horarios Pedidos</div><br /><br />
									 <?	if (sizeof($detalleReserva) != 0) {
									 		foreach ($detalleReserva as $horas) {
												print("<li>".$horas["descripcion"]."</li>");
											}
										} else {
											print("<font color=red> ERROR AL GRABAR LA RESERVA.<BR>POR FAVOR COMUNIQUESE CON LA ORGANIZACION.</font>");
										} 
									} 
								} 
								?>
								</div>
								<br />
								<div class="titulo_reserva" style="float:left;">
									Observación: <?= $reserva->observacion ?>
								</div>
						<? } else { ?>
							 	<div class="titulo_reserva" style="float:left;">Confirmarción de Partido</div>
							 <? for ($p=0; $p<count($partido); $p++) { ?>	
									<div id="partido_<?= $color ?>" style="margin-left:-25px">
									<div id="fixture_nro_partido" style="margin-left:-3px"><?="X" ?></div>
									<div id="fixture_sede"><? $oSedes = new Sedes(); $sede = $oSedes->getById($partido[$p]['idSede']); echo strtoupper($sede->nombre) ?></div>
									<div id="fixture_cancha"><?= strtoupper ($partido[$p]['cancha']); ?></div>
									<div id="fixture_equipo1"><?= strtoupper ($partido[$p]['equipo1']); ?></div>
									<? 
									if($partido[$p]['idEquipo1'] == $_SESSION['equipo']) {
										$confirmado = $oFixture->partidoConfirmado($partido[$p]['id'],$_SESSION['equipo']);
										if(!$confirmado) { ?>
											<div id="fixture_resultado1" style="margin-left:-55px"> 
												<input type="button" name="confirmar" id="confirmar" value="Confirmar" onclick="confirmarPartido(<?= $partido[$p]['id'] ?>)" />
											</div>
									 <? } else { ?>
											<div id="fixture_resultado1" style="margin-left:-55px; font-size:12px; color:#009900">Confirmado</div>
									 <? } 
									}?> 		
									<div id="fixture_horaPartido" style="margin-left:20px"><?= strtoupper ($partido[$p]['horaPartido']); ?></div>
									<div id="fixture_fechaPartido" class="fixture_color_<?= $color ?>"><?= cambiaf_a_normal($partido[$p]['fechaPartido']); ?></div>
									<div id="fixture_equipo2"><?= strtoupper ($partido[$p]['equipo2']); ?></div>
									<? 
									if($partido[$p]['idEquipo2'] == $_SESSION['equipo']) {
										$confirmado = $oFixture->partidoConfirmado($partido[$p]['id'],$_SESSION['equipo']);
										if(!$confirmado) { ?>
											<div id="fixture_resultado2" style="margin-left:-55px; margin-top:5px"> 
												<input type="button" name="confirmar" id="confirmar" value="Confirmar" onclick="confirmarPartido(<?= $partido[$p]['id'] ?>)" />
											</div>
									 <? } else { ?>
											<div id="fixture_resultado2" style="margin-left:-55px; margin-top:5px; font-size:12px; color:#009900">Confirmado</div>
									 <? } 
									}?> 
								</div>
							 <?  }
							}
						 }  ?>				
				<? } ?> 
			    </div>
			</div>
        </div>   
        <? include_once('pie.php') ?>
    </div>   
    </form>
</body>