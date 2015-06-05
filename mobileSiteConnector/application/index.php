<?php

error_reporting(0);
if($_GET['desktopVersion']==1){
	setcookie('dattaMobile_desktopVersion',1,0,'/');
	$x =rand();
	header('location: /?x='.$x);die();
}elseif($_GET['desktopVersion']===2){
	setcookie('dattaMobile_desktopVersion',NULL,-1,'/');
}

require_once './functions.php';
$mobilePage = new mobilePage();

$mobilePage->getContent();die();
?>