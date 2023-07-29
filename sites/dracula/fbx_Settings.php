<?php
/*
<fusedoc fuse="fbx_Settings.php">
	<responsibilities>
		I set up the enviroment settings for this circuit. If this settings file is being inherited, then you can set a variable outright to override a value set in a parent circuit or use if(!isset(...)) to accept a value set by a parent circuit
	</responsibilities>	
</fusedoc>
*/

//In case no fuseaction was given, I'll set up one to use by default.
	if(!isset($attributes["fuseaction"])){ $attributes["fuseaction"] = "drac.page"; }

//useful constants
	if(!isset($GLOBALS["self"])){ $GLOBALS["self"] = "index.php"; }
	$XFA = array();

//should fusebox silently suppress its own error messages? default is FALSE
	$Fusebox["suppressErrors"] = false;

if($Fusebox["isHomeCircuit"]) {
//put settings here that you want to execute only when this is the application's home circuit (for example: session_start(); )
	if(!isset($title)){$title="Dracula's Homepage";}
	if(!isset($layout)){$layout="main";}
	if(!isset($page)){$page="html/index.html";}
	if(!isset($link)){$link="index.php?fuseaction=drac.page&page=";}
	if(!isset($picture)){$picture="index.php?fuseaction=drac.picture&picture=";}

} else {
//put settings here that you want to execute only when this is not an application's home circuit

}

//Put settings out here that should run regardless of whether this is the home app or not

?>