<style type="text/css">
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
		left: 815px;
		top: 5px;
		width: 120px;
		height: 25px;
		/*background-color:#F00;*/
		cursor: pointer;
	}	
	
	#reglamento { 
		position: relative;
		left: 815px;
		top: 11px;
		width: 120px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00;*/
		cursor: pointer;
	}	

	#sedes { 
		position: relative;
		left: 815px;
		top: 17px;
		width: 120px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00;*/
		cursor: pointer;
	}	

	#contacto { 
		position: relative;
		left: 815px;
		top:  23px;
		width: 120px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00;*/
		cursor: pointer;
	}	
	
	#gf{ 
		left: 380px;
		top:  -100px;
		position: relative;
		width: 230px; 
		height: 175px;
		cursor:pointer; 
		/*background:#993300;*/
	}
	
</style>

<div id="encabezado">
    <div id="cabezal">
    	<div id="quienes_somos" onclick="window.location = 'quienes_somos.php';"></div>
      	<div id="reglamento" onclick="window.location = 'reglamento.php';"></div>
      	<div id="sedes" onclick="window.location = 'sedes.php';"></div>
      	<div id="contacto"  onclick="window.location = 'contacto.php';"></div>
		<div id="gf" onclick="location.href='index.php'"></div>
    </div>
  </div>